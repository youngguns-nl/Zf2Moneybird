<?php

namespace Youngguns\Zf2Moneybird\Transport;

use Moneybird\Transport;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception\InvalidArgumentException;

/**
 * Description of TransportPluginManager
 *
 * @author jaapio
 */
class TransportManager extends AbstractPluginManager
{
    public function __construct(\Zend\ServiceManager\ConfigInterface $configuration = null)
    {
        parent::__construct($configuration);
        $this->setFactory('Oauth', 'Youngguns\Zf2Moneybird\Transport\OauthTransportFactory');
    }
    /**
     * Validate the plugin
     *
     * Checks that the service loaded is an instance of \Moneybird\Transport.
     *
     * @param  mixed            $plugin
     * @return void
     * @throws InvalidArgumentException if invalid
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof Transport) {
            // we're okay
            return;
        }

        throw new InvalidArgumentException(sprintf(
            'Plugin of type %s is invalid; must implement \Moneybird\Transport',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin))
        ));
    }
}
