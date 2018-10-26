<?php
declare(strict_types=1);

namespace N1215\Http\Router\Result;

use PHPUnit\Framework\TestCase;

class RoutingFailureTest extends TestCase
{
    public function test_getters(): void
    {
        $error = new RoutingError(404, 'route not found');

        $result = new RoutingFailure($error);

        $this->assertFalse($result->isSuccess());
        $this->assertNull($result->getMatchedHandler());
        $this->assertEquals([], $result->getMatchedParams());
        $this->assertSame($error, $result->getError());
    }
}
