<?php

return array(
    'factories' => array(
        'Moneybird\Connector' => 'Youngguns\Zf2Moneybird\Service\ConnectorFactory',
    ),
    'abstract_factories' => array(
        'Youngguns\Zf2Moneybird\Service\ServiceFactory',
    ),
);
