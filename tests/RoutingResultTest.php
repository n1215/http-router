<?php
declare(strict_types=1);

namespace N1215\Http\Router;

use Interop\Http\Server\RequestHandlerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

class RoutingResultTest extends TestCase
{
    public function test_success()
    {
        $matchedHandler = new MockRequestHandler();
        $matchedParams = [
            'resource' => 'posts',
            'id' => '12345',
        ];

        $result = RoutingResult::success($matchedHandler, $matchedParams);

        $this->assertTrue($result->isSuccess());
        $this->assertSame($matchedHandler, $result->getMatchedHandler());
        $this->assertEquals($matchedParams, $result->getMatchedParams());
        $this->assertNull($result->getError());
    }

    public function test_failure()
    {
        $error = new RoutingError(404, 'route not found');

        $result = RoutingResult::failure($error);

        $this->assertFalse($result->isSuccess());
        $this->assertNull($result->getMatchedHandler());
        $this->assertEquals([], $result->getMatchedParams());
        $this->assertSame($error, $result->getError());
    }
}

class MockRequestHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new Response();
    }
}
