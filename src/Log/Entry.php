<?php

namespace Log;

class Entry
{
    private $date;

    private $time;

    private $serverIpAddress;

    private $method;

    private $uri;

    private $query;

    private $port;

    private $username;

    private $clientIpAddress;

    private $userAgent;

    private $returnStatus;

    private $returnSubstatus;

    private $winStatus;

    private $timeTaken;

    /**
     * Load the object from array.
     * @param array $data The data to load.
     */
    public function fromArray($data)
    {
        if (count($data) > 6) {
            $this->setDate($data[0]);
            $this->setTime($data[1]);
            $this->setServerIpAddress($data[2]);
            $this->setMethod($data[3]);
            $this->setUri($data[4]);
            $this->setQuery($data[5]);
            $this->setPort($data[6]);
            $this->setUsername($data[7]);
            $this->setClientIpAddress($data[8]);
            $this->setUserAgent($data[9]);
            $this->setReturnStatus($data[10]);
            $this->setReturnSubstatus($data[11]);
            $this->setWinStatus($data[12]);
            $this->setTimeTaken($data[13]);
        }
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     *
     * @param mixed $value
     */
    private function setDate($value)
    {
        $this->date = $value;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     *
     * @param mixed $value
     */
    private function setTime($value)
    {
        $this->time = $value;
    }

    /**
     * @return mixed
     */
    public function getServerIpAddress()
    {
        return $this->serverIpAddress;
    }

    /**
     *
     * @param mixed $value
     */
    private function setServerIpAddress($value)
    {
        $this->serverIpAddress = $value;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     *
     * @param mixed $value
     */
    private function setMethod($value)
    {
        $this->method = $value;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     *
     * @param mixed $value
     */
    private function setUri($value)
    {
        $this->uri = $value;
    }

    /**
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     *
     * @param mixed $value
     */
    private function setQuery($value)
    {
        $this->query = $value;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     *
     * @param mixed $value
     */
    private function setPort($value)
    {
        $this->port = $value;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     *
     * @param mixed $value
     */
    private function setUsername($value)
    {
        $this->username = $value;
    }

    /**
     * @return mixed
     */
    public function getClientIpAddress()
    {
        return $this->clientIpAddress;
    }

    /**
     *
     * @param mixed $value
     */
    private function setClientIpAddress($value)
    {
        $this->clientIpAddress = $value;
    }

    /**
     * @return mixed
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     *
     * @param mixed $value
     */
    private function setUserAgent($value)
    {
        $this->userAgent = $value;
    }

    /**
     * @return mixed
     */
    public function getReturnStatus()
    {
        return $this->returnStatus;
    }

    /**
     *
     * @param mixed $value
     */
    private function setReturnStatus($value)
    {
        $this->returnStatus = $value;
    }

    /**
     * @return mixed
     */
    public function getReturnSubstatus()
    {
        return $this->returnSubstatus;
    }

    /**
     *
     * @param mixed $value
     */
    private function setReturnSubstatus($value)
    {
        $this->returnSubstatus = $value;
    }

    /**
     * @return mixed
     */
    public function getWinStatus()
    {
        return $this->winStatus;
    }

    /**
     *
     * @param mixed $value
     */
    private function setWinStatus($value)
    {
        $this->winStatus = $value;
    }

    /**
     * @return mixed
     */
    public function getTimeTaken()
    {
        return $this->timeTaken;
    }

    /**
     *
     * @param mixed $value
     */
    private function setTimeTaken($value)
    {
        $this->timeTaken = $value;
    }
}