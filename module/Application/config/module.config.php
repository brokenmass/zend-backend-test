<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Transaction' => 'Application\Controller\TransactionController',
            )
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
                'list-transaction' => array(
                    'options' => array(
                        'route' => 'list transactions <merchantId>',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Transaction',
                            'action' => 'listtransaction'
                        ),
                    ),
                ),
            )
        )
    ),
);