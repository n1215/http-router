<?php
declare(strict_types=1);

namespace N1215\Http\Router\Result;

use N1215\Http\Router\RoutingResultInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class RoutingResultFactory
{
    public function make(RequestHandlerInterface $handler, array $params): RoutingResultInterface
    {
        return new RoutingResult($handler, $params);
    }
}
