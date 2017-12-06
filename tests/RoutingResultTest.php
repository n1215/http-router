<?php
declare(strict_types=1);

namespace N1215\Http\Router;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

class RoutingResultTest extends TestCase
{
    public function test_success()
    {
        $matchedHandler = new MockRequestHandler(function (ServerRequestInterface $request) {
            return new Response();
        });

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
