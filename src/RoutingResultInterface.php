<?php
declare(strict_types=1);

namespace N1215\Http\Router;

use Psr\Http\Server\RequestHandlerInterface;

interface RoutingResultInterface
{
    public function isSuccess(): bool;

    public function getMatchedHandler(): ?RequestHandlerInterface;

    public function getMatchedParams(): array;

    public function getError(): ?RoutingErrorInterface;
}
