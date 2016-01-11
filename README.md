# Alexa Wrapper

This library merely serves as a wrapper to fetch simple rank information from Alexa's web service.

## Installation

From your composer.json file, simply add the following:

    {
        "require": {
            "cforrence/alexa": "~1.0"
        }
    }

## Usage

    $api = new Forrence\Libraries\Alexa\Alexa;

    echo $api->getSiteRank('http://www.example.com');
    // 15418

    echo $api->getSiteRankReach('http://www.example.com');
    // 11482

    echo $api->getSiteRankChange('http://www.example.com');
    // 2436