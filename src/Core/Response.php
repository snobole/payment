<?php
namespace Snobole\Core;


use Snobole\Interfaces\Response as ResponseInterface;

class Response implements ResponseInterface
{
    private $error = false;
    private $errorMessage = null;
    private $response = null;

    /**
     * @param null $errorMessage
     */
    public function setError($errorMessage)
    {
        $this->error = true;
        $this->setResponse($errorMessage);
    }

    /**
     * @param null $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * @return null
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @return null
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return bool
     */
    public function hasError()
    {
        return $this->error;
    }
}