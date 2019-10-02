<?php
namespace Pessoa;

return array(
    'controllers' => array(
        'invokables' => array(
            'Pessoa\Controller\Pessoa' => 'Pessoa\Controller\PessoaController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'pessoa' => __DIR__ . '/../view',
        ),
    ),
    'router' => array(
        'routes' => array(
            'pessoa' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/pessoa[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Pessoa\Controller\Pessoa',
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