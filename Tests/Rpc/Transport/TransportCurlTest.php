<?php

/**
 * @author Łukasz Pior <pior.lukasz@gmail.com>
 */

namespace Seven\RpcBundle\Tests\Transport;

use PHPUnit\Framework\TestCase;
use Seven\RpcBundle\Rpc\Transport\RequestInterface;

class TransportCurlTest extends TestCase
{
    /**
     * @expectedException \Seven\RpcBundle\Rpc\Exception\CurlTransportException
     *
     * @dataProvider providerMakeRequestWithCurlError
     */
    public function testMakeRequestWithCurlError($errorCode, $errorMessage)
    {
        $transportMock = $this->getMockBuilder("Seven\\RpcBundle\\Rpc\\Transport\\TransportCurl")
                                ->setMethods(array("getCurlRequest"))
                                ->getMock();

        $requestMock = $this->createMock(RequestInterface::class);

        $curlRequestMock = $this->getMockBuilder("Seven\\RpcBundle\\Rpc\\Transport\\Curl\\CurlRequest")
                                ->setMethods(array("execute", "getErrorNumber", "getErrorMessage"))
                                ->getMock();

        $curlRequestMock->expects($this->once())
            ->method('execute')
            ->will($this->returnValue(false));

        $curlRequestMock->expects($this->once())
            ->method('getErrorNumber')
            ->will($this->returnValue($errorCode));

        $curlRequestMock->expects($this->once())
            ->method('getErrorMessage')
            ->will($this->returnValue($errorMessage));

        $transportMock->expects($this->once())
            ->method('getCurlRequest')
            ->will($this->returnValue($curlRequestMock));

        $transportMock->makeRequest($requestMock);
    }

    public function providerMakeRequestWithCurlError()
    {
        return array(
            array(CURLE_COULDNT_CONNECT, "Failed to connect() to host or proxy."),
            array(CURLE_OPERATION_TIMEOUTED, "Operation timeout. The specified time-out period was reached according to the conditions."),
        );
    }
}