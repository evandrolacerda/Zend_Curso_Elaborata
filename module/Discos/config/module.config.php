<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Discos\Controller\Discos' => 'Discos\Controller\DiscosController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'discos' => __DIR__ . '/../view',
        ),
    ),
    'router' => array(
        'routes' => array(
            'album' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/discos[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'    => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Discos\Controller\Discos',
                        'action' => 'index'
                    ),
                ),
            ),
        ),
    ),
);