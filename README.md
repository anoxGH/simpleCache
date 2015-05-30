# PHP SimpleCache


## Install

Install via [composer](https://getcomposer.org):

```javascript
{
    "require": {
        "anoxgh/simplecache": "dev-master"
    }
}
```

Run `composer install` then use as normal:


## Usage
```php
require_once(__DIR__.'/vendor/autoload.php');

$fileCache = new AnoxGH\SimpleCache\FileCache('Temporary/FileCache');
$fileCache->set('CacheKey', 'ExampleValue', 360);
var_dump($fileCache->get('CacheKey'));

$sessionCache = new AnoxGH\SimpleCache\SessionCache();
$sessionCache->set('CacheKey', 'ExampleValue', 360);
var_dump($sessionCache->get('CacheKey'));

$apcCache = new AnoxGH\SimpleCache\ApcCache();
$apcCache->set('CacheKey', 'ExampleValue', 360);
var_dump($apcCache->get('CacheKey'));
```

## Credits
PHP SimpleCache was created by [Sebastian Gieselmann](https://github.com/anoxGH). Released under the GPL-2.0 license.