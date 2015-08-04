<?php

namespace Grc\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception;

class GuzzleHttpClient implements IHttpClient {
    private $client;
    private $timeout;

    public function __construct($client = null, $timeout = 2.0) {
        if ($client === null) {
          $this->client = new Client();
        } else {
          $this->client = $client;
        }

        $this->timeout = $timeout;
    }

    public function fetchUrl($url) {
        try {
            $response = $this->client->get($url, array(
                'timeout' => $this->timeout,
            ));

            $code = $response->getStatusCode();
            $reason = $response->getReasonPhrase();

            if ($code == 200 && $reason == 'OK') {
                return $response->getBody();
            }
        } catch (Exception\ClientException $exception) {
            return null;
        }

        return null;
    }
}
