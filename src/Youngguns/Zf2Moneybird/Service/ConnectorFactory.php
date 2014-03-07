<?php

namespace Youngguns\Zf2Moneybird\Service;

use Moneybird\ApiConnector;
use Moneybird\XmlMapper;
use Youngguns\Zf2Moneybird\Transport\TransportManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of ConnectorFactory
 *
 * @author jaapio
 */
class ConnectorFactory implements FactoryInterface
{

    /**
     *
     * @var TransportManager
     */
    protected $transportManager;

    /**
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return ApiConnector
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $moneyBirdConfig = $config['moneybird'];

        $transport = $this->createTransport($moneyBirdConfig['transport'], $moneyBirdConfig['transport_options']);
        $connector = new ApiConnector(
            $moneyBirdConfig['clientname'], $transport, new XmlMapper()
        );

        return $connector;
    }

    protected function createTransport($transport, $config)
    {
        return $this->getTransportManager()->get($transport, $config);
    }

    /**
     * Creates a new transportPluginManager when non set.
     *
     * @return TransportManager
     */
    public function getTransportManager()
    {
        if ($this->transportManager === null) {
            $this->setTransportManager(new TransportManager());
        }

        return $this->transportManager;
    }

    /**
     *
     * @param TransportManager $transportManager
     */
    public function setTransportManager(TransportManager $transportManager)
    {
        $this->transportManager = $transportManager;
    }
}
