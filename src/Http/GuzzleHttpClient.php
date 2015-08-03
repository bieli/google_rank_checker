<?php

namespace Grc\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception;

class GuzzleHttpClient implements IHttpClient {
    public function fetchUrl($url) {
        $client = new Client();

        try {
            $response = $client->get($url, array(
                'timeout'  => 2.0,
            ));

            $code = $response->getStatusCode();
            $reason = $response->getReasonPhrase();

            if ( $code == 200 && $reason == 'OK') {
                return $response->getBody();
            }
        } catch (Exception\ClientException $exception) {
            return null;
        }

        return null;
    }
}