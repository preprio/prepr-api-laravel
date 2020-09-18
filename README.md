# Laravel Prepr API Wrapper

This Laravel package is a wrapper for the Prepr API.

#### Installation

You can install the package via composer:

```bash
composer require graphlr/prepr-api-laravel
```

#### Environment variables

```text
PREPR_URL=https://api.eu1.prepr.io/
PREPR_TOKEN=ToKeN
PREPR_CACHE=true
PREPR_CACHE_TIME=1800
```

#### Override variables

For all the requests
```php
config(['prepr.url' => 'https://api.eu1.prepr.io/']);
config(['prepr.token' => 'ToKeN']);
```

The authorization can also be set for one specific request `->url('url')->authorization('token')`.


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

##### Get Single

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

##### Put

```php
$apiRequest = (new Prepr)
    ->path('tags')
    ->params([
        'body' => 'Example'
    ])
    ->put();

if($apiRequest->getStatusCode() == 200) {
    dump($apiRequest->getResponse());
}
```

##### Delete

```php
$apiRequest = (new Prepr)
    ->path('tags/{id}',[
        'id' => 1
    ])
    ->delete();

if($apiRequest->getStatusCode() == 204) {
    // Deleted.
}
```

##### Multipart/Chunk upload

```php
$apiRequest = (new Prepr)
    ->path('assets')
    ->params([
      'body' => 'Example',
    ])
    ->file('/path/to/file.txt') // For laravel storage: storage_path('app/file.ext')
    ->post();

if($apiRequest->getStatusCode() == 200) {
    dump($apiRequest->getResponse());
}
```

##### Autopaging

```php
$apiRequest = (new Prepr)
    ->path('publications')
    ->query([
        'limit' => 200 // optional
    ])
    ->autoPaging();

if($apiRequest->getStatusCode() == 200) {
    dump($apiRequest->getResponse());
}
```


#### Debug

For debug you can use `getRawResponse()`
