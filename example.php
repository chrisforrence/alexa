<?php

require_once(__DIR__ . '/vendor/autoload.php');

$api = new Forrence\Libraries\Alexa\Alexa;
$website = 'http://www.example.com';

echo '// Site rankings for ' . $website . PHP_EOL;

$statistics = $api->getSiteStatistics($website);

echo $statistics === null ? 'No statistics' : json_encode($statistics) . PHP_EOL;

echo $api->getSiteRank($website) . PHP_EOL;
echo $api->getSiteRankReach($website) . PHP_EOL;
echo $api->getSiteRankChange($website) . PHP_EOL;