<?php

require_once(__DIR__ . '/vendor/autoload.php');

$api = new Forrence\Libraries\Alexa\Alexa;
$website = 'http://www.example.com';
echo $api->getSiteRank($website) . PHP_EOL;
echo $api->getSiteRankChange($website);