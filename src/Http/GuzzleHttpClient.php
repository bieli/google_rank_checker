<?php

namespace Grc\Http;

use GuzzleHttp\Client;

class GuzzleHttpClient implements IHttpClient {
    public function fetchUrl($url) {
        $client = new Client();

        $response = $client->get($url, array(
            'timeout'  => 2.0,
        ));

        $code = $response->getStatusCode();
        $reason = $response->getReasonPhrase();

        if ( $code == 200 && $reason == 'OK') {
            return $response->getBody();
        }

        return null;
    }
}