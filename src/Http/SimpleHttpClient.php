<?php

namespace Grc\Http;

class SimpleHttpClient implements IHttpClient {
    public function fetchUrl($url) {
        return file_get_contents($url);
    }
}
