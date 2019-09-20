<?php

namespace Graphlr\Prepr;

use GuzzleHttp\Client;

class Prepr
{
    protected $url;
    protected $callableUrl;
    protected $query;
    protected $method = 'GET';
    protected $params = [];
    protected $response;
    protected $rawResponse;
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

    protected function request()
    {
        $this->request = $this->client->request($this->method, $this->callableUrl.$this->query, [
            'form_params' => $this->params,
        ]);

        $this->response = json_decode($this->request->getBody()->getContents(), true);
        $this->rawResponse = $this->request->getBody()->getContents();

        return $this;
    }

    public function get()
    {
        $this->method = 'get';

        return $this->request();
    }

    public function post()
    {
        $this->method = 'post';

        return $this->request();
    }

    public function put()
    {
        $this->method = 'put';

        return $this->request();
    }

    public function delete()
    {
        $this->method = 'delete';

        return $this->request();
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
        return $this->response;
    }

    public function getRawResponse()
    {
        return $this->rawResponse;
    }

    public function getStatusCode()
    {
        return $this->request->getStatusCode();
    }
}