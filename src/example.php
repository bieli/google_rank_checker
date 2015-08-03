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

