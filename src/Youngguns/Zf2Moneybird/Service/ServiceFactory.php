<?php

namespace Youngguns\Zf2Moneybird\Service;

use Moneybird\InvalidServiceTypeException;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of ServiceFactory
 *
 * @author otterdijk
 */
class ServiceFactory implements AbstractFactoryInterface
{

    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        if ($serviceLocator->has('Moneybird\Connector')) {
            $connector = $serviceLocator->get('Moneybird\Connector');

            try {
                $connector->getService($this->formatMoneybirdService($requestedName));
                return true;
            } catch (InvalidServiceTypeException $ex) {
                //silent fall through
            }
        }

        return false;
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $connector = $serviceLocator->get('Moneybird\Connector');
        return $connector->getService($this->formatMoneybirdService($requestedName));
    }

    protected function formatMoneybirdService($requestedName)
    {
        $parts = explode('\\', $requestedName);
        if ($parts[0] === 'Moneybird') {
            return $parts[1];
        }

        return $requestedName;
    }
}
