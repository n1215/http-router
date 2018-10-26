<?php
declare(strict_types=1);

namespace N1215\Http\Router\Result;

use N1215\Http\Router\RoutingErrorInterface;
use N1215\Http\Router\RoutingResultInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class RoutingFailure implements RoutingResultInterface
{
    /** @var RoutingErrorInterface|null  */
    private $error;

    public function __construct(RoutingErrorInterface $error = null)
    {
        $this->error = $error;
    }

    public function isSuccess(): bool
    {
        return false;
    }

    public function getMatchedHandler(): ?RequestHandlerInterface
    {
        return null;
    }

    public function getMatchedParams(): array
    {
        return [];
    }

    public function getError(): ?RoutingErrorInterface
    {
        return $this->error;
    }
}
