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

#### Usage

```text
use Graphlr\Prepr\Prepr;

new Prepr()
```

```text
app('prepr')
```

```text
$data = app('prepr')
    ->query([
        'fields' => 'source_file'
    ])
    ->url('assets')
    ->method('GET')
    ->call();
```
