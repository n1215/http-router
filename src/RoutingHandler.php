<?php
declare(strict_types=1);

namespace N1215\Http\Router;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class RoutingHandler implements RoutingHandlerInterface
{
    /** @var RouterInterface  */
    private $router;

    /** @var RoutingErrorResponderInterface  */
    private $errorResponder;

    public function __construct(RouterInterface $router, RoutingErrorResponderInterface $errorResponder)
    {
        $this->router = $router;
        $this->errorResponder = $errorResponder;
    }

    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $result = $this->router->match($request);

        if (!$result->isSuccess()) {
            return $this->errorResponder->respond($request, $result->getError());
        }

        foreach ($result->getMatchedParams() as $name => $value) {
            $request = $request->withAttribute($name, $value);
        }

        return $result->getMatchedHandler()->handle($request);
    }
}
