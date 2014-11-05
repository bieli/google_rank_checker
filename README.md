## Google rank checker

[![Build Status](https://travis-ci.org/bieli/google_rank_checker.png?branch=master)](http://travis-ci.org/bieli/google_rank_checker)


### General info


Google rank checker - PHP library for building SEO tools


## Specification

This repository it is tool set for free using.

Usage
-----

If you need checking for keyword for domain you need execute:

```php
<?php

require __DIR__ . '/../vendor/autoload.php';

use RankChecker\Google\Google;

$grc = new Google();

$grc->setKeyword('marcin bielak');
$grc->setUrl('bieli.net');
$grc->setSearchDomain('google.pl');

try
{
    $grc->check();
    echo $grc->getResultsAsString();
}
catch(\BadMethodCallException $e)
{
    die($e->getMessage());
}
catch(\Exception $e)
{
    die($e->getMessage());
}

```


