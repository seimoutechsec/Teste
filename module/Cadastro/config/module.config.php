<?php
namespace Cadastro;

return array(
    'controllers' => array(
        'invokables' => array(
            'Cadastro\Controller\Cadastro' => 'Cadastro\Controller\CadastroController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'cadastro' => __DIR__ . '/../view',
        ),
    ),
    'router' => array(
        'routes' => array(
            'cadastro' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/cadastro[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Cadastro\Controller\Cadastro',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),    
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    )
);