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
        $request = $this->client->request($this->method, $this->callableUrl.$this->query, [
            'form_params' => $this->params,
        ]);

        return json_decode($request->getBody()->getContents(), true);
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
}