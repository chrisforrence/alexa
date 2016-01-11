<?php

namespace Forrence\Libraries\Alexa;


class Alexa
{
    private $client;

    /**
     * Constructs a Alexa
     * @param $api_key
     * @param $api_secret
     * @param $use_https bool Deprecated, v2 always uses HTTPS
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    public function getSiteRank($uri)
    {
        $result = $this->client->makeGetRequest('data', [
            'cli' => 10,
            'dat' => 'snbamz',
            'url' => $uri,
        ]);
        if(($body = new \SimpleXMLElement($result->getBody()->getContents())) == null) {
            return null;
        }
        return $body->SD[1]->REACH['RANK'];
    }

    public function getSiteRankChange($uri)
    {
        $result = $this->client->makeGetRequest('data', [
            'cli' => 10,
            'dat' => 'snbamz',
            'url' => $uri,
        ]);
        if(($body = new \SimpleXMLElement($result->getBody()->getContents())) == null) {
            return null;
        }
        return str_replace("+", "", $body->SD[1]->RANK['DELTA']);
    }
}