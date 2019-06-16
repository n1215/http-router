<?php
declare(strict_types=1);

namespace N1215\Http\Router\Result;

use N1215\Http\Router\MockRequestHandler;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

class RoutingResultTest extends TestCase
{
    public function test_getters(): void
    {
        $handler = new MockRequestHandler(function (ServerRequestInterface $request) {
            return new Response();
        });
        $params = [
            'resource' => 'posts',
            'id' => '12345',
        ];

        $result = new RoutingResult($handler, $params);

        $this->assertSame($handler, $result->getHandler());
        $this->assertEquals($params, $result->getParams());
    }
}
