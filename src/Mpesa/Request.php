<?php

namespace Snobole\Mpesa;

use Snobole\Mpesa\Core\AuthToken;
use Snobole\Request as CoreRequest;
use Snobole\Core\Response;
use Snobole\Mpesa\Services\Validator;

class Request extends Response
{
    /**
     * @param string $api Name of api as in the configuration file
     * @param array $formParams
     * @param array $configParams
     * @return Request
     */
    public function sendRequest(string $api, array $formParams, array $configParams)
    {
        try {
            $validator = new Validator;
            $validator->validateApiEndpoint($api);
            $validator->validateRequiredConfigParameters($configParams);
            $validator->validateFormParameters($api, $formParams);
        } catch (\Exception $e) {
            $this->setError($e->getMessage());
            return $this;
        }

        $request = (new CoreRequest())->initializeRequest('mpesa');
        $request->setAuthType('Bearer');
        $request->setToken((new AuthToken($configParams))->generate());
        $request->setParams($formParams);

        $environment = $configParams['environment'];

        $this->setResponse($request->post($configParams[$environment]['urls'][$api]));

        return $this;
    }

}