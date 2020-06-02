<?php

namespace Snobole\Mpesa\Services;

use Snobole\Services\Config;
use Snobole\Services\DotNotationResolver;

class Validator
{

    private $top_config_params = [
        'environment',
        'sandbox',
        'live',
    ];

    private $supported_api_endpoints = [
        'token',
        'c2b',
        'b2c',
        'b2b',
        'account_balance',
        'reversal',
        'transaction_status',
        'stk_push',
        'stk_push_query'
    ];

    public function validateRequiredConfigParameters(array $configParams)
    {
        $livePaths = $this->generateDotNotationPaths('live');
        $sandboxPaths = $this->generateDotNotationPaths('sandbox');
        $dotNotationPaths = array_merge($sandboxPaths, $livePaths, $this->top_config_params);

        $this->validate($configParams, $dotNotationPaths, 'configuration');
    }

    public function validateFormParameters($api, $formParams)
    {
        if (!$requiredFormParams = Config::get('mpesa.form_params.' . $api, 'app')) {
            throw new \InvalidArgumentException('The transaction type : ' . $api . ' is not supported');
        }

        $this->validate($formParams, $requiredFormParams, 'form');
    }

    /**
     * @param $api
     */
    public function validateApiEndpoint($api)
    {
        if (!in_array($api, $this->supported_api_endpoints)) {
            throw new \InvalidArgumentException('The api : ' . $api . ' is not supported');
        }
    }

    private function generateDotNotationPaths($environment)
    {
        $paths = [
            $environment . '.consumer_key',
            $environment . '.consumer_secret',
            $environment . '.shortcode',
        ];

        foreach ($this->supported_api_endpoints as $param) {
            $paths[] = $environment . '.urls.' . $param;
        }
        return $paths;
    }

    private function validate(array $array, array $paths, string $parameterType = '')
    {

        $resolver = new DotNotationResolver();
        $resolver->checkMissing($array, $paths);

        if ($missing = $resolver->getMissing())
            throw new \InvalidArgumentException('The following required ' . $parameterType . ' parameters are missing: ' . $missing);
    }
}