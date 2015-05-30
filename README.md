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
$fileCache = new AnoxGH\SimpleCache\FileCache('Temporary/FileCache');
$fileCache->set('CacheKey', 'ExampleValue', 360);
var_dump($fileCache->get('CacheKey'));

$fileCache->flush('CacheKey');


$sessionCache = new AnoxGH\SimpleCache\SessionCache();
$sessionCache->set('CacheKey', 'ExampleValue', 360);

var_dump($sessionCache->get('CacheKey'));

$sessionCache->flush('CacheKey');

$apcCache = new AnoxGH\SimpleCache\ApcCache();
$apcCache->set('CacheKey', 'ExampleValue', 360);
var_dump($apcCache->get('CacheKey'));

$apcCache->flush('CacheKey');

$memoryCache = new AnoxGH\SimpleCache\MemoryCache();
$memoryCache->set('CacheKey', 'ExampleValue', 360);
var_dump($memoryCache->get('CacheKey'));

$memoryCache->flush('CacheKey');

$memCacheServer = array(
            array('127.0.0.1', 7000, 10),
            array('127.0.0.2', 7000, 20));

$memCache = new AnoxGH\SimpleCache\MemCache($memCacheServer);
$memCache->set('CacheKey', 'ExampleValue', 360);
var_dump($memCache->get('CacheKey'));

$memCache->flush('CacheKey');
```

## Credits
PHP SimpleCache was created by [Sebastian Gieselmann](https://github.com/anoxGH). Released under the GPL-2.0 license.