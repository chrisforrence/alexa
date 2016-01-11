<?php

namespace Forrence\Libraries\Alexa;

use GuzzleHttp\Client as Guzzle;

class Client
{
    private $api_uri = 'http://data.alexa.com/';

    /**
     * Sets up a client for using the Alexa library
     */
    public function __construct()
    {
    }

    /**
     * Sets up a GET request
     * @param $endpoint
     * @param array $parameters
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function makeGetRequest($endpoint, $parameters = [])
    {
        return $this->makeRequest('GET', $endpoint, $parameters);
    }

    /**
     * Sets up a POST request
     * @param $endpoint
     * @param array $parameters
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function makePostRequest($endpoint, $parameters = [])
    {
        return $this->makeRequest('POST', $endpoint, $parameters);
    }

    /**
     * Sets up a PUT request
     * @param $endpoint
     * @param array $parameters
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function makePutRequest($endpoint, $parameters = [])
    {
        return $this->makeRequest('PUT', $endpoint, $parameters);
    }

    /**
     * Sets up a DELETE request
     * @param $endpoint
     * @param array $parameters
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function makeDeleteRequest($endpoint, $parameters = [])
    {
        return $this->makeRequest('DELETE', $endpoint, $parameters);
    }

    private function makeRequest($verb, $endpoint, $parameters)
    {
        $options = [
            'http_errors' => false,
            'verify' => false,
            'headers' => [
                'Content-Length' => 0
            ],
        ];
        if ($verb === 'GET') {
            $options['query'] = $parameters;
        } else {
            $options['form_params'] = $parameters;
        }
        $client = new Guzzle();
        try {
            $result = $client->request($verb, $this->api_uri . $endpoint, $options);
        } catch (GuzzleHttp\Exception\RequestException $e) {
            echo $e->getRequest();
            if ($e->hasResponse()) {
                echo $e->getResponse();
            }
        } catch (GuzzleHttp\Exception\ConnectException $e) {
            echo 'Could not connect';
            $result = null;
        }
        return $result;
    }
}
