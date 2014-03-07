<?php

namespace Youngguns\Zf2Moneybird\Transport;

use Moneybird\HttpClient\Oauth;
use Moneybird\Lib\OAuthConsumer;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\MutableCreationOptionsInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of OauthTransportFactory
 *
 * @author jaapio
 */
class OauthTransportFactory implements FactoryInterface, MutableCreationOptionsInterface
{
    protected $options;

    /**
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return Oauth
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $oauth = new Oauth(isset($this->options['connection']) ? $this->options['connection'] : array());
        $consumer = new OAuthConsumer(
            $this->options['consumer_key'],
            $this->options['consumer_secret']
        );

        $token = new OAuthConsumer(
            $this->options['token'],
            $this->options['token_secret']
        );

        $oauth->setConsumerAndToken($consumer, $token);

        return $oauth;
    }

    public function setCreationOptions(array $options)
    {
        $this->options = $options;
    }
}
