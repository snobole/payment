<?php


namespace Snobole\Services;


class DotNotationResolver
{
    private $missing;

    public function resolve($array, $path, $default = null)
    {
        if (is_null($path)) return $array;

        if (isset($array[$path])) return $array[$path];

        foreach (explode('.', $path) as $segment) {

            if (!is_array($array) || !array_key_exists($segment, $array)) {
                return $default;
            }

            $array = $array[$segment];
        }

        return $array;
    }

    public function checkMissing($array, array $paths, $default = null)
    {
        foreach ($paths as $path) {
            if (!$this->resolve($array, $path)) {
                $this->missing[] = $path;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getMissing()
    {
        return is_array($this->missing) ? implode(', ', $this->missing) : $this->missing;
    }
}