<?php

namespace Pessoa\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface; 

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="pessoafisica") 
 */

Class PessoaFisica extends Pessoa
{     
     /**
     * @var InputFilter
     */
    protected $inputFilter;

    /**
     * @var \Pessoa
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Pessoa")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })     
     */        
    protected $id;
     
    /**
     * @ORM\Column(type="string")
     */
    protected $rg;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $cpf;    

    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function exchangeArray($data = array()) 
    {
        $this->id = $data['id'];
        $this->situacao = $data['situacao'];           
        $this->id_estado_civil = $data['id_estado_civil'];        
        $this->email = $data['email'];
        $this->telefone = $data['telefone'];
        $this->nome_fantasia = $data['nome_fantasia'];
        $this->razaosocial = $data['razaosocial'];        
        $this->id1 = $data['id1'];
        $this->rg = $data['rg'];
        $this->cpf = $data['cpf'];
    }              
    
    public function getInputFilter()
    {
        if (!$this->inputFilter) 
        {
            $inputFilter = new InputFilter();
 
            $inputFilter->add(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));     
            
            $inputFilter->add(array(
                'name'     => 'situacao',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));
            
            $inputFilter->add(array(
                'name'     => 'id_estado_civil',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));
            
            $inputFilter->add(array(
                'name'     => 'email',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));
 
            $inputFilter->add(array(
                'name'     => 'telefone',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));
 
            $inputFilter->add(array(
                'name'     => 'nome_fantasia',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));
            
            $inputFilter->add(array(
                'name'     => 'razaosocial',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));
            
            $inputFilter->add(array(
                'name'     => 'id1',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));
            
            $inputFilter->add(array(
                'name'     => 'rg',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));
            
            $inputFilter->add(array(
                'name'     => 'cpf',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));
            
            $this->inputFilter = $inputFilter;
        }
 
        return $this->inputFilter;
    }    
}