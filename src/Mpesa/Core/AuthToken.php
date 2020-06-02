<?php
namespace Snobole\Mpesa\Core;

use Snobole\Mpesa\Interfaces\Token as TokenInterface;
use Snobole\Request;

class AuthToken implements TokenInterface
{
    protected $environment = 'sandbox';
    protected $consumer_key;
    protected $consumer_secret;
    protected $url;

    public function __construct(array $config)
    {
        $environment = $config['environment'];
        $params = $config[$environment];

        $this->url = $params['urls']['token'];
        $this->consumer_secret = $params['consumer_secret'];
        $this->consumer_key = $params['consumer_key'];
        $this->environment = $environment;
    }

    public function generate()
    {
        $requestFactory = new Request();
        $request = $requestFactory->initializeRequest('mpesa');
        $request->setToken(base64_encode($this->consumer_key.':'.$this->consumer_secret));
        $request->setAuthType('Basic');

        return $request->get($this->url);
    }
}