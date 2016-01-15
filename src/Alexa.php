<?php

namespace Forrence\Libraries\Alexa;

class Alexa
{
    private $client;

    /**
     * Constructs a Alexa element
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Gets the free statistics for Alexa
     * 
     * @param string $uri   The URI to check
     * 
     * @return array|null   ['rank' => 'string', 'reach' => 'string', 'backlinks' => 'int', 'change' => 'string']
     */
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
            'backlinks' => (int) (isset($body->SD[0]->LINKSIN) ? $body->SD[0]->LINKSIN['NUM'] : 0),
            'change' => (string) str_replace("+", "", $body->SD[1]->RANK['DELTA']),
        ];
    }

    /**
     * Gets a site's rank according to Alexa
     *
     * @param string $uri   The URI to check
     *
     * @return string|null  The site's rank
     */
    public function getSiteRank($uri)
    {
        $body = $this->getSiteStatistics($uri);
        return $body === null ? null : $body['rank'];
    }

    /**
     * Gets a site's reach according to Alexa
     *
     * @param string $uri   The URI to check
     *
     * @return string|null  The site's rank reach
     */
    public function getSiteRankReach($uri)
    {
        $body = $this->getSiteStatistics($uri);
        return $body === null ? null : $body['reach'];
    }

    /**
     * Gets a site's rank change according to Alexa
     *
     * @param string $uri   The URI to check
     *
     * @return string|null  The site's rank change
     */
    public function getSiteRankChange($uri)
    {
        $body = $this->getSiteStatistics($uri);
        return $body === null ? null : $body['change'];
    }
}
