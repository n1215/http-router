<?php
declare(strict_types=1);

namespace N1215\Http\Router;

use Interop\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;

interface RoutingResultInterface
{
    public function getRequest(): ServerRequestInterface;

    public function getMatchedHandler(): ?RequestHandlerInterface;

    public function getMatchedParams(): array;

    public function isSuccess(): bool;

    public function getError(): ?RoutingErrorInterface;
}
