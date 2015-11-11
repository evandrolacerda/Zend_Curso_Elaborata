<?php

namespace Discos;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Discos\Model\Discos;
use Discos\Model\DiscosTable;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface {

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Discos\Model\DiscosTable' => function( $sm ) {
                    $tableGateway = $sm->get('DiscosTableGateway');
                    $table = new DiscosTable($tableGateway);
                    return $table;
                },
                'DiscosTableGateway' => function( $sm ) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype( new Discos() );
                    return new TableGateway('discos', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

//fim do método
}
