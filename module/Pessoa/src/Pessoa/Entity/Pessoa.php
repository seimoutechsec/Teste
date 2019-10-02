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
 * @ORM\Table(name="pessoa")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string") 
 * @ORM\DiscriminatorMap({"pessoa"="Pessoa", "pessoafisica"="PessoaFisica", "pessoajuridica"="PessoaJuridica"}) 
 */

class Pessoa implements InputFilterAwareInterface 
{   
     /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;   
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $situacao; 
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $id_estado_civil;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @ORM\Column(type="string")
     */
    protected $telefone;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $nome_fantasia;        
    
    /**
     * @ORM\Column(type="string")
     */
    protected $razaosocial;
    
    public function getInputFilter() {
        
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    /**
     * Magic getter to expose protected properties.
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property) 
    {
        return $this->$property;
    }

    /**
     * Magic setter to save protected properties.
     *
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value) 
    {
        $this->$property = $value;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        return get_object_vars($this);
    }
}
