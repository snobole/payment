<?php

namespace Snobole\Services;

class Arr
{
    private $missingKeys = null;

    public function flatten(array $array)
    {
        $return = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $return = array_merge($return, self::flatten($value));
            } else {
                $return[$key] = $value;
            }
        }

        return $return;
    }

    public function keys($array)
    {
        {
            $keys = [];

            foreach ($array as $key => $value) {
                $keys[] = $key;
                if (is_array($value)) {
                    $keys = array_merge($keys, self::keys($value));
                }
            }
            return array_unique($keys);
        }
    }

    public function keyExists(array $arr, $key)
    {
        // is in base array?
        if (array_key_exists($key, $arr)) {
            return true;
        }

        // check arrays contained in this array
        foreach ($arr as $element) {
            if (is_array($element)) {
                if ($this->keyExists($element, $key)) {
                    return true;
                }
            }

        }
        return false;
    }

    public function allKeysExist(array $arr, $keys)
    {
        foreach ($keys as $key) {
            if (!$this->keyExists($arr, $key)){
                $this->missingKeys .= $key.' ';
            }
        }
        if ($this->missingKeys)
            return false;

        return true;
    }

    /**
     * @return null
     */
    public function getMissingKeys()
    {
        return $this->missingKeys;
    }
}