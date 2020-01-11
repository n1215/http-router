<?php
declare(strict_types=1);

namespace N1215\Http\Router\Handler;

use N1215\Http\Router\Exception\MethodNotAllowedException;
use N1215\Http\Router\Exception\RouteNotFoundException;
use N1215\Http\Router\MockFailureRouter;
use N1215\Http\Router\MockRequestHandler;
use N1215\Http\Router\MockRoutingErrorResponder;
use N1215\Http\Router\MockSuccessRouter;
use N1215\Http\Router\RouterInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\TextResponse;
use Laminas\Diactoros\ServerRequest;

class RoutingHandlerTest extends TestCase
{
    public function test_handle_when_route_matched(): void
    {
        $response = new Response();
        $params = ['dummy' => 'param'];
        $handler = new MockRequestHandler(function (ServerRequestInterface $request) use ($response, $params) {
            $this->assertEquals('param', $request->getAttribute('dummy'));
            return $response;
        });

        $router = new MockSuccessRouter($handler, $params);
        $routingHandler = $this->makeRoutingHandler($router);

        $result = $routingHandler->handle(new ServerRequest());

        $this->assertInstanceOf(ResponseInterface::class, $result);
        $this->assertSame($response, $result);
    }

    public function test_handle_when_route_not_matched(): void
    {
        $message = 'route not found';

        $router = new MockFailureRouter(new RouteNotFoundException($message));
        $routingHandler = $this->makeRoutingHandler($router);

        $result = $routingHandler->handle(new ServerRequest());

        $this->assertInstanceOf(TextResponse::class, $result);
        $this->assertEquals(404, $result->getStatusCode());
        $this->assertEquals($message, $result->getBody()->__toString());
    }

    public function test_handle_when_method_not_allowed(): void
    {
        $message = 'method not allowed';

        $router = new MockFailureRouter(new MethodNotAllowedException($message));
        $routingHandler = $this->makeRoutingHandler($router);

        $result = $routingHandler->handle(new ServerRequest());

        $this->assertInstanceOf(TextResponse::class, $result);
        $this->assertEquals(405, $result->getStatusCode());
        $this->assertEquals($message, $result->getBody()->__toString());
    }

    private function makeRoutingHandler(RouterInterface $router): RoutingHandler
    {
        $notFoundResponder = new MockRoutingErrorResponder(RouteNotFoundException::class, 404);
        $methodNotFoundResponder = new MockRoutingErrorResponder(MethodNotAllowedException::class, 405);
        return new RoutingHandler($router, $notFoundResponder, $methodNotFoundResponder);
    }
}
