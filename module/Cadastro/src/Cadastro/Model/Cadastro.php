<?php
namespace Cadastro\Model;

use Zend\InputFilter\Factory as InputFactory; 
use Zend\InputFilter\InputFilter; 
use Zend\InputFilter\InputFilterAwareInterface; 
use Zend\InputFilter\InputFilterInterface; 

class Cadastro
{
    public $id;
    public $id_estado_civil;
    public $email;
    public $telefone;
    public $nome_fantasia;
    public $razaosocial;
    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->id_estado_civil = (isset($data['id_estado_civil'])) ? $data['id_estado_civil'] : null;
        $this->email = (isset($data['email'])) ? $data['email'] : null;
        $this->telefone = (isset($data['telefone'])) ? $data['telefone'] : null;
        $this->nome_fantasia = (isset($data['nome_fantasia'])) ? $data['nome_fantasia'] : null;
        $this->razaosocial = (isset($data['razaosocial'])) ? $data['razaosocial'] : null;
    }
    
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
    
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
    
    public function getInputFilter()
    {
        if (!$this->inputFilter) 
        {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();
            $inputFilter->add($factory->createInput(array(
                                                        'name' => 'id',
                                                        'required' => true,
                                                        'filters' => array(
                                                                        array('name' => 'Int'),
                                                                        ),
                                                        )
                                                    )
                            );
            
            $inputFilter->add($factory->createInput(array(
                                                        'name' => 'id_estado_civil',
                                                        'required' => true,
                                                        'filters' => array(
                                                                        array('name' => 'Int'),
                                                                        ),
                                                        )
                                                    )
                            );
            
            $inputFilter->add($factory->createInput(array(
                                                        'name' => 'email',
                                                        'required' => true,
                                                        'filters' => array(
                                                                        array('name' => 'StripTags'),
                                                                        array('name' => 'StringTrim'),
                                                                        ),
                                                        'validators' => array(
                                                                            array(
                                                                                'name' => 'StringLength',
                                                                                'options' => array(
                                                                                                'encoding' => 'UTF-8',
                                                                                                'min' => 1,
                                                                                                'max' => 100,
                                                                                                ),
                                                                                ),
                                                                            ),
                                                        )
                                                    )
                            );
            
            $inputFilter->add($factory->createInput(array(
                                                        'name' => 'telefone',
                                                        'required' => true,
                                                        'filters' => array(
                                                                        array('name' => 'StripTags'),
                                                                        array('name' => 'StringTrim'),
                                                                        ),
                                                        'validators' => array(
                                                                            array(
                                                                                'name' => 'StringLength',
                                                                                'options' => array(
                                                                                                'encoding' => 'UTF-8',
                                                                                                'min' => 1,
                                                                                                'max' => 100,
                                                                                                ),
                                                                                ),
                                                                        ),
                                                        )
                                                    )
                            );
            
            $inputFilter->add($factory->createInput(array(
                                                        'name' => 'nome_fantasia',
                                                        'required' => true,
                                                        'filters' => array(
                                                                        array('name' => 'StripTags'),
                                                                        array('name' => 'StringTrim'),
                                                                        ),
                                                        'validators' => array(
                                                                            array(
                                                                                'name' => 'StringLength',
                                                                                'options' => array(
                                                                                                'encoding' => 'UTF-8',
                                                                                                'min' => 1,
                                                                                                'max' => 100,
                                                                                                ),
                                                                                ),
                                                                        ),
                                                        )
                                                    )
                            );
            
            $inputFilter->add($factory->createInput(array(
                                                        'name' => 'razaosocial',
                                                        'required' => true,
                                                        'filters' => array(
                                                                        array('name' => 'StripTags'),
                                                                        array('name' => 'StringTrim'),
                                                                        ),
                                                        'validators' => array(
                                                                            array(
                                                                                'name' => 'StringLength',
                                                                                'options' => array(
                                                                                                'encoding' => 'UTF-8',
                                                                                                'min' => 1,
                                                                                                'max' => 100,
                                                                                                ),
                                                                                ),
                                                                        ),
                                                        )
                                                    )
                            );
            
            $this->inputFilter = $inputFilter;
        }
            
        return $this->inputFilter;        
    }    
}