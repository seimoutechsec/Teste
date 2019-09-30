<?php
namespace Cadastro\Model;

use Zend\Db\TableGateway\TableGateway;

class CadastroTable
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
    
    public function getCadastro($id)
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
    
    public function saveCadastro(Cadastro $cadastro)
    {
        $data = array(
                    'id_estado_civil' => $cadastro->id_estado_civil,
                    'email' => $cadastro->email,
                    'telefone' => $cadastro->telefone,
                    'nome_fantasia' => $cadastro->nome_fantasia,
                    'razaosocial' => $cadastro->razaosocial,
                );
        
        $id = (int)$cadastro->id;
        
        if ($id == 0) 
        {
            $this->tableGateway->insert($data);
        } 
        else 
        {
            if ($this->getCadastro($id)) 
            {
                $this->tableGateway->update($data, array('id' => $id));
            } 
            else 
            {
                throw new \Exception('Form id does not exist');
            }
        }
    }
    
    public function deleteCadastro($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}