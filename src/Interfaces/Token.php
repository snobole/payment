<?php


namespace Snobole\Interfaces;


interface Token
{
    /**
     * @param $environment
     * @param null $password
     * @return mixed
     */
    public function generate($environment, $password = null);
}