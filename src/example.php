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
$grc = new Google($httpClient);

$grc->setKeyword('marcin bielak');
$grc->setUrl($url);
$grc->setSearchDomain('google.pl');

$grc->check();

echo $grc->getResultsAsString();
