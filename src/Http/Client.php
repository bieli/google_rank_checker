<?php

namespace Grc\Http;

class Client {
    public function fetchUrl($url) {
        return file_get_contents($url);
    }
}
