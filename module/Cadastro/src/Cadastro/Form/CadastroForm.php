<?php
namespace Cadastro\Form;

use Zend\Form\Form;

class CadastroForm extends Form
{
    public function __construct($name = null)
    {        
        parent::__construct('cadastro');
        
        $this->setAttribute('method', 'post');
        $this->add(array(
                    'name' => 'id',
                    'attributes' => array(
                                        'type' => 'hidden',
                                    ),
                        )
                );
        $this->add(array(
                    'name' => 'id_estado_civil',
                    'attributes' => array(
                                        'type' => 'int',
                                    ),
                    'options' => array(
                                    'label' => 'Estado Civil',
                                    ),
                    )
                );
        $this->add(array(
                    'name' => 'email',
                    'attributes' => array(
                                        'type' => 'text',
                                    ),
                    'options' => array(
                                    'label' => 'E-mail',
                                    ),
                    )
                );
        $this->add(array(
                    'name' => 'telefone',
                    'attributes' => array(
                                        'type' => 'text',
                                    ),
                    'options' => array(
                                    'label' => 'Telefone',
                                    ),
                        )
                );
        $this->add(array(
                    'name' => 'nome_fantasia',
                    'attributes' => array(
                                        'type' => 'text',
                                    ),
                    'options' => array(
                                    'label' => 'Nome Fantasia',
                                    ),
                    )
                );
        $this->add(array(
                    'name' => 'razaosocial',
                    'attributes' => array(
                                        'type' => 'text',
                                    ),
                    'options' => array(
                                    'label' => 'Razão Social',
                                    ),
                    )
                );
        $this->add(array(
                    'name' => 'submit',
                    'attributes' => array(
                                        'type' => 'submit',
                                        'value' => 'Go',
                                        'id' => 'submitbutton',
                                    ),
                        )
                );
    }
}