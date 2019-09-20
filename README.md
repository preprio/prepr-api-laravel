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

#### Examples


```text
use Graphlr/Prepr/Prepr;
```

##### Get All

```text
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

```text
$apiRequest = (new Prepr)
    ->path('tags/{id}')
    ->pathParams([
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

```text
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