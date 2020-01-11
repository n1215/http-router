<?php
declare(strict_types=1);

namespace N1215\Http\Router\Result;

use N1215\Http\Router\MockRequestHandler;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response;

class RoutingResultFactoryTest extends TestCase
{
    public function test_make(): void
    {
        $factory = new RoutingResultFactory();
        $handler = new MockRequestHandler(function (ServerRequestInterface $request) {
            return new Response();
        });
        $params = [
            'resource' => 'posts',
            'id' => '12345',
        ];

        $result = $factory->make($handler, $params);

        $this->assertSame($handler, $result->getHandler());
        $this->assertEquals($params, $result->getParams());
    }
}
