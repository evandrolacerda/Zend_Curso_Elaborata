<?php
namespace Discos\Model;

use Zend\Db\TableGateway\TableGateway;

/**
 * Description of DiscosTable
 *
 * @author Administrador
 */
class DiscosTable 
{
    protected $tableGateway;
    
    public function __construct( TableGateway $tableGateway )
    {
        $this->tableGateway = $tableGateway;
                
    }
    
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    
    public function saveDiscos( Discos $discos )
    {
        $data = array(
            'cantor' => $discos->cantor,
            'disco' => $discos->disco,
        );
        
        $id = (int) $discos->id;
        
        if( $id == 0 )
        {
            $this->tableGateway->insert($data);            
        }else{
            if( $this->getDisco( $id ) ){
                $this->tableGateway->update($data, array('id' => $id ));
            }else{
                throw new \Exception('Disco id nao existe');
            }
        }
    }
    
    public function deleteDiscos( $id )
    {
        $this->tableGateway->delete( array( 'id' => $id ) );
    }
    
    public function getDisco( $id )
    {
        $id = (int) $id;
        
        $rowset = $this->tableGateway->select( array( 'id' => $id ) );
        $row = $rowset->current();
        if( !$row )
        {
            throw new \Exception('Não foi Possível encontrar o registro com id ' .$id );
        }
        return $row;
    }
    
    
}
