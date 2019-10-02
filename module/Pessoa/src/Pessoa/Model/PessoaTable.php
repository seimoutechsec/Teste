<?php
namespace Pessoa\Model;

use Zend\Db\TableGateway\TableGateway;

class PessoaTable
{
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    
    public function getPessoa($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        
        if (!$row) 
        {
            throw new \Exception("Could not find row $id");
        }
        
        return $row;
    }
    
    public function savePessoa(Pessoa $pessoa)
    {
        $data = array(
                    'id_estado_civil' => $pessoa->id_estado_civil,
                    'email' => $pessoa->email,
                    'telefone' => $pessoa->telefone,
                    'nome_fantasia' => $pessoa->nome_fantasia,
                    'razaosocial' => $pessoa->razaosocial,
                );
        
        $id = (int)$pessoa->id;
        
        if ($id == 0) 
        {
            $this->tableGateway->insert($data);
        } 
        else 
        {
            if ($this->getpessoa($id)) 
            {
                $this->tableGateway->update($data, array('id' => $id));
            } 
            else 
            {
                throw new \Exception('Form id does not exist');
            }
        }
    }
    
    public function deletePessoa($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}