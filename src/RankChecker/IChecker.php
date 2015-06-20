<?php

namespace RankChecker;

interface IChecker
{
    public function setSearchDomain($searchDomain);
    public function setKeyword($keyword);
    public function setUrl($url);
} 
