## Google rank checker

[![Build Status](https://travis-ci.org/bieli/google_rank_checker.png?branch=master)](http://travis-ci.org/bieli/google_rank_checker)


### General info


Google page rank checker - PHP library for building SEO tools


## Specification

This repository it is tool set for free using.


Usage
-----

If you need checking for keyword for domain you need below PHP code:

```php
<?php

namespace Grc\Example;

require __DIR__ . '/../vendor/autoload.php';

use \Grc\Http\GuzzleHttpClient;
use \Grc\RankChecker\Google\Google;

$url = 'bieli.net';

if ($_SERVER['argc'] > 1) {
    $url = trim($_SERVER['argv'][1]);
}

$httpClient = new GuzzleHttpClient();

try
{
    $grc = new Google($httpClient);

    $grc->setKeyword('marcin bielak');
    $grc->setUrl($url);
    $grc->setSearchDomain('google.pl');
    $grc->check();

    echo $grc->getPageRank();
}
catch (\Exception $exception)
{
    printf("[ ERROR ] Exception '%s': '%s'\n",  get_class($exception), $exception->getMessage());
}

```

#### or run example:

```
$ php src/example.php github.com
```

#### example output:

8


#### how to run unit tests:

```
$ php ./vendor/phpunit/phpunit/phpunit tests/
```

