<?php
declare(strict_types=1);

namespace N1215\Http\Router\Result;

use PHPUnit\Framework\TestCase;

class RoutingErrorTest extends TestCase
{
    public function test_getStatusCode(): void
    {
        $error = new RoutingError(404, 'route not found');
        $this->assertEquals(404, $error->getStatusCode());
    }

    public function test_getMessage(): void
    {
        $error = new RoutingError(405, 'method not allowed');
        $this->assertEquals('method not allowed', $error->getMessage());
    }
}
