<?php
declare(strict_types=1);

namespace N1215\Http\Router;

use N1215\Http\Router\Result\RoutingResult;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;

class MockSuccessRouter implements RouterInterface
{
    /** @var RequestHandlerInterface  */
    private $handler;

    /** @var array  */
    private $params;

    public function __construct(RequestHandlerInterface $matchedHandler, array $matchedParams)
    {
        $this->handler = $matchedHandler;
        $this->params = $matchedParams;
    }

    public function match(ServerRequestInterface $request): RoutingResultInterface
    {
        return new RoutingResult($this->handler, $this->params);
    }
}
