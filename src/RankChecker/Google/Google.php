<?php

namespace RankChecker\Google;

use IChecker;
//use RankChecker\IChecker;

class Google //implements IChecker
{
    private $searchDomain;
    private $keyword;
    private $url;

    public function __construct() {

    }

    public function setSearchDomain($googleDomain) {
        $this->googleDomain = trim($googleDomain);

        if (empty($googleDomain)) {
            throw new \InvalidArgumentException('Empty google domain');
        }

        $this->searchDomain = $googleDomain;
    }

    public function setKeyword($keyword) {
        $keyword = trim($keyword);

        if (empty($keyword)) {
            throw new \InvalidArgumentException('Empty keyword');
        }

        $this->keyword = $keyword;
    }

    public function setUrl($url) {
        $url = trim($url);

        if (empty($url)) {
            throw new \InvalidArgumentException('Empty url');
        }

        $this->url = $url;
    }

    public function check() {
        if (empty($this->searchDomain)
            || empty($this->keyword)
            || empty($this->url)
        ) {
            throw new \BadMethodCallException('You need to use all setters to set up "Google" object');
        }
    }

    public function getResultsAsString() {
        return $this->searchDomain .  ':' . $this->keyword . ':' .  $this->url . "\n\n";
    }
}
