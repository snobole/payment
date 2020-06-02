<?php


namespace Snobole\Services;

class Config
{
    /**
     * @param string $pattern Dot separated path to array key
     * @param string $fileName
     * @return mixed|null
     */
    public static function get(string $pattern, $fileName)
    {
        $path = getcwd() . '/config/' . $fileName . '.php';
        if (!file_exists($path)) {
            throw new \InvalidArgumentException('The specified configuration file ' . $fileName . ' was not found');
        }

        return (new DotNotationResolver)->resolve(include $path, $pattern);
    }
}