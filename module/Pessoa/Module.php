<?php
namespace Pessoa;

use Pessoa\Model\Pessoa;
use Pessoa\Model\PessoaTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getAutoloaderConfig()
    {
        return array('Zend\Loader\ClassMapAutoloader' => array(__DIR__ . '/autoload_classmap.php',),
                     'Zend\Loader\StandardAutoloader' => array('namespaces' => array(__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,),),
                    );
    }
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Pessoa\Model\PessoaTable' => function($sm) 
                {
                    $tableGateway = $sm->get('PessoaTableGateway');
                    $table = new \PessoaTable($tableGateway);
                    return $table;
                },
                    
                'PessoaTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Pessoa());
                
                    return new TableGateway('pessoa', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}
