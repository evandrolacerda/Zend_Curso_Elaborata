<?php
namespace Discos\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Discos\Form\DiscosForm;
use Discos\Model\Discos;

class DiscosController extends AbstractActionController {
    
    protected $discosTable;
    
    public function getDiscosTable()
    {
        if( !$this->discosTable )
        {
            $sm = $this->getServiceLocator();
            $this->discosTable = $sm->get('Discos\Model\DiscosTable');
        }
        
        return $this->discosTable;
    }

    public function indexAction()
    {
        return new ViewModel( array(
            'discos' => $this->getDiscosTable()->fetchAll(),
        ) );
    }

    public function addAction() 
    {
        $form = new DiscosForm();
        
        $form->get('submit')->setValue('Cadastrar');
        
        $request = $this->getRequest();
        
        if( $request->isPost() )
        {
            $disco = new Discos();
            $form->setInputFilter( $disco->getInputFilter() );
            
            $form->setData( $request->getPost() );
            
            
            if( $form->isValid() )
            {
                $disco->exchangeArray( $form->getData() );
                $this->getDiscosTable()->saveDiscos( $disco );
                
                return $this->redirect()->toRoute('album');
            }
        }
        
        return array('form' => $form );
        
    }

    public function editAction() {
        
    }
    
    public function deleteAction()
    {
        
    }

}
