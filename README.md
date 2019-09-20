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

##### Get

```text
$apiRequest = (new Prepr)
    ->method('get')
    ->url('tags')
    ->query([
        'fields' => 'example'
    ])
    ->call();

if($apiRequest->getStatusCode() == 200) {
    dump($apiRequest->getResponse());
}
```

##### Post

```text
$apiRequest = (new Prepr)
    ->method('post')
    ->url('tags')
    ->params([
        'body' => 'Example'
    ])
    ->call();

if($apiRequest->getStatusCode() == 201) {
    dump($apiRequest->getResponse());
}
```