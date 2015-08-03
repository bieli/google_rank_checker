<?php

namespace Grc\RankChecker\Google;

use Grc\RankChecker\IChecker;

class Google extends GoogleRankHash implements IChecker
{
    const CHECK_QUERY = "http://toolbarqueries.google.com/tbr?client=navclient-auto&ch=%s&features=Rank&q=info:%s&num=100&filter=0";

    private $searchDomain;
    private $keyword;
    private $url;
    private $pagerank;
    private $httpClient;

    public function __construct($httpClient) {
        $this->httpClient = $httpClient;
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

		$query = sprintf(self::CHECK_QUERY, $this->checkHash($this->hashURL($this->url)), $this->url);

		$data = $this->httpClient->fetchUrl($query);

		$pos = strpos($data, "Rank_");

		if($pos !== false){
			$this->pagerank = substr($data, $pos + 9);
			return $this->pagerank;
		}

        return null;
    }

    public function getResultsAsString() {
        return $this->searchDomain .  ':' . $this->keyword . ':' .  $this->url . ":" . $this->pagerank . "\n\n";
    }

    public function getPageRank() {
        return $this->pagerank;
    }
}

