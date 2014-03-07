<?php
namespace Youngguns\Zf2Moneybird;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

/**
 * Description of Module
 *
 * @author jaapio
 */
class Module implements ConfigProviderInterface, ServiceProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../../../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return include __DIR__ . '/../../../config/servicemanager.config.php';
    }
}
