<?php
declare(strict_types=1);

namespace N1215\Http\Router\Result;

use N1215\Http\Router\RoutingErrorInterface;
use N1215\Http\Router\RoutingResultInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class RoutingSuccess implements RoutingResultInterface
{
    /** @var RequestHandlerInterface|null  */
    private $matchedHandler;

    /** @var array  */
    private $matchedParams;

    public function __construct(?RequestHandlerInterface $matchedHandler, array $matchedParams = [])
    {
        $this->matchedHandler = $matchedHandler;
        $this->matchedParams = $matchedParams;
    }

    public function isSuccess(): bool
    {
        return true;
    }

    public function getMatchedHandler(): ?RequestHandlerInterface
    {
        return $this->matchedHandler;
    }

    public function getMatchedParams(): array
    {
        return $this->matchedParams;
    }

    public function getError(): ?RoutingErrorInterface
    {
        return null;
    }
}
