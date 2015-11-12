<?php
namespace Discos\Form;

use Zend\Form\Form;

class DiscosForm  extends Form{
    
    public function __construct( $name = null )
    {
        parent::__construct('discos');
        
        
        $this->setAttribute('method', 'post');
        
        $this->add( array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));
        
        $this->add( array(
            'name' => 'disco',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Disco'
            ),
        ) );
        
        $this->add( array(
            'name' => 'cantor',
            'attributes' => array(
                'type' => 'text'
            ),
            'options' => array(
                'label' => 'Cantor',
            )
        ) );
        
        $this->add( array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Cadastrar',
                'id' => 'submitbutton'
            ),
        ) );
    }
}
