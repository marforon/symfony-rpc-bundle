<?php
/*
 * This file is part of the Symfony bundle Seven/Rpc.
 *
 * (c) Sergey Kolodyazhnyy <sergey.kolodyazhnyy@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Seven\RpcBundle\Rpc;

use Seven\RpcBundle\Rpc\Method\MethodCall;
use Seven\RpcBundle\Rpc\Method\MethodResponse;
use Seven\RpcBundle\Rpc\Transport\RequestInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// @codeCoverageIgnoreStart
abstract class Implementation
{
    /**
     * @param  Request $request
     * @return mixed
     */

    abstract public function createMethodCall(Request $request);

    /**
     * @param  Response $response
     * @return MethodResponse
     */

    abstract public function createMethodResponse(Response $response);

    /**
     * @param  MethodResponse $response
     * @param int $statusCode
     * @return Response
     */

    abstract public function createHttpResponse(MethodResponse $response, $statusCode = Response::HTTP_OK);

    /**
     * @param  MethodCall $call
     * @return RequestInterface
     */

    abstract public function createHttpRequest(MethodCall $call);

}
// @codeCoverageIgnoreEnd
