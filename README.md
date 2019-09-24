# Laravel Prepr API Wrapper

This Laravel package is a wrapper for the Prepr API.

#### Installation

You can install the package via composer:

```bash
composer require graphlr/prepr-api-laravel
```

#### Environment variables

```text
PREPR_URL=
PREPR_TOKEN=
```

#### Override variables

For all the requests
```php
config(['prepr.url' => 'url']);
config(['prepr.token' => 'token']);
```

If you want only have other variable for one request you can add `->url('url')->authorization('token')`


#### Examples

```php
use Graphlr\Prepr\Prepr;
```

##### Get All

```php
$apiRequest = (new Prepr)
    ->path('tags')
    ->query([
        'fields' => 'example'
    ])
    ->get();

if($apiRequest->getStatusCode() == 200) {
    dump($apiRequest->getResponse());
}
```

##### Get One

```php
$apiRequest = (new Prepr)
    ->path('tags/{id}',[
        'id' => 1
    ]),
    ->query([
        'fields' => 'example'
    ])
    ->get();

if($apiRequest->getStatusCode() == 200) {
    dump($apiRequest->getResponse());
}
```

##### Post

```php
$apiRequest = (new Prepr)
    ->path('tags')
    ->params([
        'body' => 'Example'
    ])
    ->post();

if($apiRequest->getStatusCode() == 201) {
    dump($apiRequest->getResponse());
}
```

#### Debug

For debug you can use `getRawResponse()`