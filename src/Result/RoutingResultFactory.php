<?php
declare(strict_types=1);

namespace N1215\Http\Router\Result;

use N1215\Http\Router\RoutingResultFactoryInterface;
use N1215\Http\Router\RoutingResultInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class RoutingResultFactory implements RoutingResultFactoryInterface
{
    public function success(RequestHandlerInterface $matchedHandler, array $matchedParams = []): RoutingResultInterface
    {
        return new RoutingSuccess($matchedHandler, $matchedParams);
    }

    public function failure(int $statusCode, string $message): RoutingResultInterface
    {
        return new RoutingFailure(new RoutingError($statusCode, $message));
    }
}
