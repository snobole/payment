<?php


namespace Snobole\Interfaces;


interface Request
{
    public function post($url, array $params);
    public function get($url);
}