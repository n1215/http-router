<?php
declare(strict_types=1);

namespace N1215\Http\Router\Result;

use N1215\Http\Router\MockRequestHandler;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

class RoutingResultFactoryTest extends TestCase
{
    public function test_success(): void
    {
        $factory = new RoutingResultFactory();
        $matchedHandler = new MockRequestHandler(function (ServerRequestInterface $request) {
            return new Response();
        });
        $matchedParams = [
            'resource' => 'posts',
            'id' => '12345',
        ];

        $result = $factory->success($matchedHandler, $matchedParams);

        $this->assertTrue($result->isSuccess());
        $this->assertSame($matchedHandler, $result->getMatchedHandler());
        $this->assertEquals($matchedParams, $result->getMatchedParams());
        $this->assertNull($result->getError());
    }

    public function test_failure(): void
    {
        $factory = new RoutingResultFactory();

        $result = $factory->failure(404, 'route not found');

        $this->assertFalse($result->isSuccess());
        $this->assertNull($result->getMatchedHandler());
        $this->assertEquals([], $result->getMatchedParams());
        $this->assertSame(404, $result->getError()->getStatusCode());
        $this->assertSame('route not found', $result->getError()->getMessage());
    }
}
