<?php

namespace Graphlr\Prepr;

use GuzzleHttp\Client;
use Cache;
use Artisan;

class Prepr
{
    protected $baseUrl;
    protected $path;
    protected $query;
    protected $method;
    protected $params = [];
    protected $response;
    protected $rawResponse;
    protected $request;
    protected $authorization;
    protected $cache;
    protected $cacheTime;

    public function __construct()
    {
        $this->cache = config('prepr.cache');
        $this->cacheTime = config('prepr.cache_time');
        $this->baseUrl = config('prepr.url');
        $this->authorization = config('prepr.token');
    }

    protected function client()
    {
        return new Client([
            'http_errors' => false,
            'headers' => array_merge(
                config('prepr.headers'),
                [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => $this->authorization
                ]
            )
        ]);
    }

    protected function request($options = [])
    {
        $url = $this->baseUrl.$this->path;

        $cacheHash = null;
        if($this->method == 'get' && $this->cache) {

            $cacheHash = md5($url.$this->authorization.$this->query);
            if(Cache::has($cacheHash)) {

                $data = Cache::get($cacheHash);

                $this->request = data_get($data,'request');
                $this->response = data_get($data,'response');

                return $this;
            }
        }

        $this->client = $this->client();

        $data = [
            'form_params' => $this->params
        ];
        
        if($this->method == 'post') {
            $data = [
                'multipart' => $this->nestedArrayToMultipart($this->params)
            ];
        }
            
        $this->request = $this->client->request($this->method, $url.$this->query,$data);

        $this->rawResponse = $this->request->getBody()->getContents();
        $this->response = json_decode($this->rawResponse, true);

        if($this->cache) {
            $data = [
                'request' => $this->request,
                'response' => $this->response
            ];
            Cache::put($cacheHash, $data, $this->cacheTime);
        }
        return $this;
    }

    public function authorization($authorization)
    {
        $this->authorization = $authorization;

        return $this;
    }

    public function url($url) {
        $this->baseUrl = $url;

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

    public function path($path = null, array $array = [])
    {
        foreach($array as $key => $value) {
            $path = str_replace('{' . $key . '}', $value, $path);
        }

        $this->path = $path;

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

    public function nestedArrayToMultipart($array)
    {
        $flatten = function ($array, $original_key = '') use (&$flatten) {
            $output = [];
            foreach ($array as $key => $value) {
                $new_key = $original_key;
                if (empty($original_key)) {
                    $new_key .= $key;
                } else {
                    $new_key .= '[' . $key . ']';
                }

                if (is_array($value)) {
                    $output = array_merge($output, $flatten($value, $new_key));
                } else {
                    $output[$new_key] = $value;
                }
            }
            return $output;
        };

        $flat_array = $flatten($array);

        $multipart = [];
        foreach ($flat_array as $key => $value) {
            $multipart[] = [
                'name' => $key,
                'contents' => $value
            ];
        }

        return $multipart;
    }

    public function clearCache()
    {
        return Artisan::call('cache:clear');
    }
}
