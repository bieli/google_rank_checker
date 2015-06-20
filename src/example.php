<?php

require __DIR__ . '/../vendor/autoload.php';

use Http\Client;
use RankChecker\Google\Google;

$url = 'bieli.net';

if ($_SERVER['argc'] > 1) {
    $url = trim($_SERVER['argv'][1]);
}

$httpClient = new Client();
$grc = new Google($httpClient);

$grc->setKeyword('marcin bielak');
$grc->setUrl($url);
$grc->setSearchDomain('google.pl');

$grc->check();

echo $grc->getResultsAsString();
