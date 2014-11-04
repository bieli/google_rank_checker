<?php

namespace Tests\RankChecker\Google;

use RankChecker\Google\Google;

class GoogleRankCheckerTest extends \PHPUnit_Framework_TestCase
{
    public function testIfObjectExists() {
        $this->assertTrue(new Google() instanceof Google);
    }

    public function testShouldSetSearchDomain() {
        // given
        $searchDomain = "google.pl";

        // when
        $obj = new Google();
        $obj->setSearchDomain($searchDomain);

        // then
        $this->assertTrue(true);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExpectExceptionWhenSetSearchDomainWithEmptyString() {
        // given
        $searchDomain = "";

        // when
        $obj = new Google();
        $obj->setSearchDomain($searchDomain);
    }

    public function testShouldSetKeyword() {
        // given
        $keyword = "test";

        // when
        $obj = new Google();
        $obj->setSearchDomain($keyword);

        // then
        $this->assertTrue(true);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExpectExceptionWhenSetKeywordWithEmptyString() {
        // given
        $keyword = "";

        // when
        $obj = new Google();
        $obj->setKeyword($keyword);
    }

    public function testShouldSetUrl() {
        // given
        $url = "http://bieli.net";

        // when
        $obj = new Google();
        $obj->setUrl($url);

        // then
        $this->assertTrue(true);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExpectExceptionWhenSetUrlWithEmptyString() {
        // given
        $url = "";

        // when
        $obj = new Google();
        $obj->setUrl($url);
    }

    public function testShouldCheck() {
        // given
        $keyword = "marcin bielak";
        $url = "http://bieli.net";

        $obj = new Google();
        $obj->setKeyword($keyword);
        $obj->setUrl($url);
        $obj->setSearchDomain('google.pl');

        // when
        $obj->check();

        // then
        $this->assertTrue(true);
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testExpectBadMethodCallExceptionWhenCheckWithoutAllSetters() {
        // given
        $keyword = "marcin bielak";
        $url = "http://bieli.net";

        $obj = new Google();
        $obj->setKeyword($keyword);
        $obj->setUrl($url);

        // when
        $obj->check();
    }

    public function testShouldGetResultsAsString() {
        // given
        $expectedResult = 'google.pl:marcin bielak:http://bieli.net' . "\n\n";
        $keyword = "marcin bielak";
        $url = "http://bieli.net";

        $obj = new Google();
        $obj->setKeyword($keyword);
        $obj->setUrl($url);
        $obj->setSearchDomain('google.pl');

        $obj->check();

        // when
        $result = $obj->getResultsAsString();

        // then
        $this->assertEquals($expectedResult, $result);
    }

}
 