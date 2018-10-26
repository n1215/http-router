<?php
declare(strict_types=1);

namespace N1215\Http\Router\Result;

use N1215\Http\Router\MockRequestHandler;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

class RoutingSuccessTest extends TestCase
{
    public function test_getters(): void
    {
        $matchedHandler = new MockRequestHandler(function (ServerRequestInterface $request) {
            return new Response();
        });
        $matchedParams = [
            'resource' => 'posts',
            'id' => '12345',
        ];

        $result = new RoutingSuccess($matchedHandler, $matchedParams);

        $this->assertTrue($result->isSuccess());
        $this->assertSame($matchedHandler, $result->getMatchedHandler());
        $this->assertEquals($matchedParams, $result->getMatchedParams());
        $this->assertNull($result->getError());
    }
}
