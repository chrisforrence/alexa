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

    public function getSiteStatistics($uri)
    {
         $result = $this->client->makeGetRequest('data', [
            'cli' => 10,
            'dat' => 'snbamz',
            'url' => $uri,
        ]);
        if (($body = new \SimpleXMLElement($result->getBody()->getContents())) == null) {
            return null;
        }

        return [
            'rank' => (string) $body->SD[1]->POPULARITY['TEXT'],
            'reach' => (string) $body->SD[1]->REACH['RANK'],
            'change' => str_replace("+", "", $body->SD[1]->RANK['DELTA']),
        ];
    }

    public function getSiteRank($uri)
    {
        $body = $this->getSiteStatistics($uri);
        return $body === null ? null : $body['rank'];
    }

    public function getSiteRankReach($uri)
    {
        $body = $this->getSiteStatistics($uri);
        return $body === null ? null : $body['reach'];
    }

    public function getSiteRankChange($uri)
    {
        $body = $this->getSiteStatistics($uri);
        return $body === null ? null : $body['change'];
    }
}
