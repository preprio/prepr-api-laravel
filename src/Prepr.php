<?php

namespace Graphlr\Prepr;

use GuzzleHttp\Client;

class Prepr
{
    protected $url;
    protected $query;
    protected $callableUrl;
    protected $method = 'GET';
    protected $params = [];
    protected $request;

    public function __construct()
    {
        $this->client = new Client([
            'http_errors' => false,
            'headers' => array_merge(
                config('prepr.headers'),
                [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => config('prepr.token')
                ]
            )
        ]);

        $this->baseUrl = config('prepr.base_url');
    }

    public function call()
    {
        $this->request = $this->client->request($this->method, $this->callableUrl.$this->query, [
            'form_params' => $this->params,
        ]);

        return $this->request;
    }

    public function url($url = null)
    {
        $this->callableUrl = $this->baseUrl.$url;

        return $this;
    }

    public function method($method = null)
    {
        $this->method = $method;

        return $this;
    }

    public function query(array $array)
    {
        $this->query = '?'.http_build_query($array);

        return $this;
    }

    public function params(array $array)
    {
        $this->params = $array;

        return $this;
    }

    public function getResponse()
    {
        return json_decode($this->request->getBody()->getContents(), true);
    }

    public function getRawResponse()
    {
        return $this->request->getBody()->getContents();
    }

    public function getStatusCode()
    {
        return $this->request->getStatusCode();
    }
}