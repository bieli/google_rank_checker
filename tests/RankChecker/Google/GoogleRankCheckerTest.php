<?php

namespace RankChecker\Google;

use Grc\Http\SimpleHttpClient;
use Grc\RankChecker\Google\Google;

/**
 * Class GoogleRankCheckerTest
 * @package Tests\RankChecker\Google
 */

/** @noinspection PhpIllegalPsrClassPathInspection */
class GoogleRankCheckerTest extends \PHPUnit_Framework_TestCase
{
    private $httpClient;

    public function setUp() {
        $this->httpClient = new SimpleHttpClient();
    }

    public function testIfObjectExists() {
        $this->assertTrue(new Google($this->httpClient) instanceof Google);
    }

    public function testShouldSetSearchDomain() {
        // given
        $searchDomain = "google.pl";

        $httpClientMock = $this->prepareMockForNeverUsedFetchUrl();

        $obj = new Google($httpClientMock);

        // when
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

        $httpClientMock = $this->prepareMockForNeverUsedFetchUrl();

        $obj = new Google($httpClientMock);

        $obj->setSearchDomain($searchDomain);
    }

    public function testShouldSetKeyword() {
        // given
        $keyword = "test";

        $httpClientMock = $this->prepareMockForNeverUsedFetchUrl();

        $obj = new Google($httpClientMock);
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

        $httpClientMock = $this->prepareMockForNeverUsedFetchUrl();

        $obj = new Google($httpClientMock);
        $obj->setSearchDomain($keyword);

        // when
        $obj = new Google($httpClientMock);
        $obj->setKeyword($keyword);
    }

    public function testShouldSetUrl() {
        // given
        $url = "http://bieli.net";

        $httpClientMock = $this->prepareMockForNeverUsedFetchUrl();

        $obj = new Google($httpClientMock);

        // when
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

        $httpClientMock = $this->prepareMockForNeverUsedFetchUrl();

        $obj = new Google($httpClientMock);

        // when
        $obj->setUrl($url);
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testExpectExceptionWhenWebserviceReturnEmptyDataResult() {
        // given
        $keyword = "abbbbbbbbbbaaaaaaaaaabbbbbbbccccadsoijadfoiahhdfasdkfjsf";
        $url = "http://bieli.net";

        $httpClientMock = $this->getMock('GuzzleHttpClient', array('fetchUrl'));
        $httpClientMock->expects($this->once())
            ->method('fetchUrl')
            ->will($this->returnValue(null));

        $obj = new Google($httpClientMock);
        $obj->setKeyword($keyword);
        $obj->setUrl($url);
        $obj->setSearchDomain('google.pl');

        // when
        $obj->check();
    }

    public function testShouldCheck() {
        // given
        $keyword = "marcin bielak";
        $url = "http://bieli.net";

        $httpClientMock = $this->getMock('SimpleHttpClient', array('fetchUrl'));
        $httpClientMock->expects($this->once())
            ->method('fetchUrl')
            ->will($this->returnValue('Rank_1:1:1'));

        $obj = new Google($httpClientMock);
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

        $httpClientMock = $this->prepareMockForNeverUsedFetchUrl();

        $obj = new Google($httpClientMock);
        $obj->setKeyword($keyword);
        $obj->setUrl($url);

        // when
        $obj->check();
    }

    /**
     * @Tests
     */
    public function testShouldGetResultsAsString() {
        // given
        $expectedResult = 'google.pl:marcin bielak:http://bieli.net:1' . "\n\n";
        $keyword = "marcin bielak";
        $url = "http://bieli.net";

        $httpClientMock = $this->getMock('SimpleHttpClient', array('fetchUrl'));
        $httpClientMock->expects($this->once())
            ->method('fetchUrl')
            ->will($this->returnValue('Rank_1:1:1'));

        $obj = new Google($httpClientMock);
        $obj->setKeyword($keyword);
        $obj->setUrl($url);
        $obj->setSearchDomain('google.pl');

        // when
        $obj->check();
        $result = $obj->getResultsAsString();

        // then
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function prepareMockForNeverUsedFetchUrl()
    {
        $httpClientMock = $this->getMock('SimpleHttpClient', array('fetchUrl'));
        $httpClientMock->expects($this->never())
            ->method('fetchUrl');
        return $httpClientMock;
    }
}
