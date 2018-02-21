<?php
declare(strict_types=1);

namespace N1215\Http\Router;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;

class MockSuccessRouter implements RouterInterface
{
    /** @var RequestHandlerInterface  */
    private $matchedHandler;

    /** @var array  */
    private $matchedParams;

    public function __construct(RequestHandlerInterface $matchedHandler, array $matchedParams)
    {
        $this->matchedHandler = $matchedHandler;
        $this->matchedParams = $matchedParams;
    }

    public function match(ServerRequestInterface $request): RoutingResultInterface
    {
        return RoutingResult::success($this->matchedHandler, $this->matchedParams);
    }
}
