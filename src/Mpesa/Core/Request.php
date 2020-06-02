<?php
namespace Snobole\Mpesa\Core;

use Snobole\Interfaces\Request as RequestInterface;

class Request implements RequestInterface
{
    protected $method;
    protected $url;
    protected $token;
    protected $params;
    protected $auth_type;
    protected $ssl_verify_peer;

    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    public function setParams(array $params)
    {
        $this->params = $params;
        return $this;
    }

    public function setSSLVerifyPeer($verify)
    {
        $this->ssl_verify_peer = $verify;
        return $this;
    }

    public function setAuthType($type)
    {
        $this->auth_type = $type;
        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function post($url, array $params = [])
    {
        $this->setUrl($url);
        $this->setParams($params);

        if (!$this->url)
            throw new \InvalidArgumentException('No url was set: '.$url);


        $auth_type = $this->auth_type;
        $this->setMethod('post');
        $this->setUrl($this->url);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);

        if($this->params)
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($this->params));

        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $this->ssl_verify_peer);

        if ($auth_type && ($auth_type == 'Bearer' || $auth_type == 'Basic')) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, ['Accept: application/json', 'Content-Type: application/json', 'Authorization: '.$auth_type.' '.$this->token]);
        }

        return curl_exec($curl);
    }

    public function get($url)
    {
        $this->setUrl($url);

        if (!$url = $this->url)
            throw new \InvalidArgumentException('No url was set');

        $auth_type = $this->auth_type;
        $this->setUrl($url);
        $this->setMethod('get');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $this->ssl_verify_peer);

        if ($auth_type && ($auth_type == 'Bearer' || $auth_type == 'Basic')) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, ['Accept: application/json', 'Content-Type: application/json', 'Authorization: '.$auth_type.' '.$this->token]);
        }

        return curl_exec($curl);
    }
}