<?php
declare(strict_types=1);

namespace N1215\Http\Router\Result;

use N1215\Http\Router\RoutingResultInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class RoutingResult implements RoutingResultInterface
{
    /** @var RequestHandlerInterface  */
    private $handler;

    /** @var array  */
    private $params;

    public function __construct(RequestHandlerInterface $handler, array $params = [])
    {
        $this->handler = $handler;
        $this->params = $params;
    }

    public function getHandler(): RequestHandlerInterface
    {
        return $this->handler;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}
