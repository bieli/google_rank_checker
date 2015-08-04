<?php

namespace Http;

use Grc\Http\GuzzleHttpClient;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;
/**
 * Class GoogleRankCheckerTest
 * @package Tests\Http\GuzzleHttpClient
 */

/** @noinspection PhpIllegalPsrClassPathInspection */
class GuzzleHttpClientTest extends \PHPUnit_Framework_TestCase
{
    private $httpClient;

    public function setUp() {
        $this->httpClient = new GuzzleHttpClient();
    }

    public function testShouldConstructWithClientAndNotNullTimeout() {
        // given
        $clientMock = null;
        $timeout = 2.0;
        $url = 'google.com';

        $clientMock = $this->getMock('GuzzleHttp\Client', array('get'));
        $clientMock->expects($this->once())
            ->method('get')
            ->will($this->returnValue(new Response()));

        $unit = new GuzzleHttpClient($clientMock, $timeout);

        // when
        $result = $unit->fetchUrl($url);

        // then
        $this->assertNotNull($result);
    }

    public function testShouldConstructClientReturnBody() {
        // given
        $clientMock = null;
        $timeout = 2.0;
        $url = 'google.com';
        $expectedResultPageRank = 9;

        $responseMock = $this->getMock(
            'GuzzleHttp\Psr7\Response',
            array(
                'getStatusCode',
                'getReasonPhrase',
                'getBody'
            )
        );
        $responseMock->expects($this->once())
            ->method('getStatusCode')
            ->will($this->returnValue(200));
        $responseMock->expects($this->once())
            ->method('getReasonPhrase')
            ->will($this->returnValue('OK'));
        $responseMock->expects($this->once())
            ->method('getBody')
            ->will($this->returnValue($expectedResultPageRank));

        $clientMock = $this->getMock('GuzzleHttp\Client', array('get'));
        $clientMock->expects($this->once())
            ->method('get')
            ->will($this->returnValue($responseMock));

        $unit = new GuzzleHttpClient($clientMock, $timeout);

        // when
        $result = $unit->fetchUrl($url);

        // then
        $this->assertEquals($expectedResultPageRank, $result);
    }
}
