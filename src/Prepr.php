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
            'headers' => config('prepr.headers')
        ]);

        $this->baseUrl = config('prepr.base_url');
    }

    protected function call()
    {
        $request = $this->client->request($this->method, $this->callableUrl.$this->query, [
            'form_params' => $this->params,
        ]);

        return json_decode($request
            ->getBody()
            ->getContents(), true);
    }

    protected function setGetUrl($url = null)
    {
        $this->method = 'GET';
        $this->callableUrl = $this->baseUrl.$url;

        return $this;
    }

    public function setPostUrl($url)
    {
        $this->method = 'POST';
        $this->callableUrl = $this->baseUrl.$url;

        return $this;
    }

    public function setDeleteUrl($url)
    {
        $this->method = 'DELETE';
        $this->callableUrl = $this->baseUrl.$url;

        return $this;
    }

    protected function addQuery(array $array)
    {
        $this->query = '?'.http_build_query($array);

        return $this;
    }

    protected function setParams(array $array)
    {
        $this->params = $array;

        return $this;
    }
}
