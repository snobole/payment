<?php


namespace Snobole\Interfaces;


interface Response
{
    /**
     * Set an error message
     * @param $errorMessage
     * @return mixed
     */
    public function setError($errorMessage);

    /**
     * Set the response from a request or error message
     * @param $response
     * @return mixed
     */
    public function setResponse($response);

    /**
     * Get the response from a request or error message
     * @return mixed
     */
    public function getResponse();

    /**
     * Check if response has an error
     * @return bool
     */
    public function hasError();

}