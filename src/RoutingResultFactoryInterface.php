<?php
declare(strict_types=1);

namespace N1215\Http\Router;

use Psr\Http\Server\RequestHandlerInterface;

interface RoutingResultFactoryInterface
{
    public function success(RequestHandlerInterface $matchedHandler, array $matchedParams = []): RoutingResultInterface;

    public function failure(int $statusCode, string $message): RoutingResultInterface;
}
