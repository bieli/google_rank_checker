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
}
//catch(RankChecker\Exceptions\ServerNotFoundException $e)
//{
//}
//catch(RankChecker\Exceptions\ServerProxyException $e)
//{
//}
//catch(RankChecker\Exceptions\Exception $e)
//{
//}
catch(\Exception $e)
{
}

