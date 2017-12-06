<?php
declare(strict_types=1);

namespace N1215\Http\Router;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\TextResponse;
use Zend\Diactoros\ServerRequest;

class RoutingHandlerTest extends TestCase
{
    public function test_handle_when_route_matched()
    {
        $response = new Response();
        $matchedParams = ['dummy' => 'param'];
        $matchedHandler = new MockRequestHandler(function (ServerRequestInterface $request) use ($response, $matchedParams) {
            $this->assertEquals('param', $request->getAttribute('dummy'));
            return $response;
        });

        $router = new MockSuccessRouter($matchedHandler, $matchedParams);
        $routingErrorResponder = new MockRoutingErrorResponder();
        $routingHandler = new RoutingHandler($router, $routingErrorResponder);

        $result = $routingHandler->handle(new ServerRequest());

        $this->assertInstanceOf(ResponseInterface::class, $result);
        $this->assertSame($response, $result);
    }

    public function test_handle_when_route_not_matched()
    {
        $message = 'route not found';
        $statusCode = 404;

        $router = new MockFailureRouter($statusCode, $message);

        $routingErrorResponder = new MockRoutingErrorResponder();
        $routingHandler = new RoutingHandler($router, $routingErrorResponder);

        $result = $routingHandler->handle(new ServerRequest());

        $this->assertInstanceOf(TextResponse::class, $result);
        $this->assertEquals($statusCode, $result->getStatusCode());
        $this->assertEquals($message, $result->getBody()->__toString());
    }
}
