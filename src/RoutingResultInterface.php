<?php
declare(strict_types=1);

namespace N1215\Http\Router;

use Psr\Http\Server\RequestHandlerInterface;

interface RoutingResultInterface
{
    public function getHandler(): RequestHandlerInterface;

    public function getParams(): array;
}
