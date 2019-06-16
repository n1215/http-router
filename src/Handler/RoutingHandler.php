<?php
declare(strict_types=1);

namespace N1215\Http\Router\Handler;

use LogicException;
use N1215\Http\Router\Exception\RoutingException;
use N1215\Http\Router\RouterInterface;
use N1215\Http\Router\RoutingResultInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class RoutingHandler implements RoutingHandlerInterface
{
    /** @var RouterInterface */
    private $router;

    /** @var RoutingErrorResponderInterface[] */
    private $errorResponders;

    public function __construct(
        RouterInterface $router,
        RoutingErrorResponderInterface ...$errorResponders
    ) {
        $this->router = $router;
        $this->errorResponders = $errorResponders;
    }

    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $result = $this->router->match($request);
        } catch (RoutingException $exception) {
            return $this->failure($exception, $request);
        }

        return $this->success($result, $request);
    }

    private function failure(RoutingException $exception, ServerRequestInterface $request): ResponseInterface
    {
        foreach ($this->errorResponders as $errorResponder) {
            if ($errorResponder->supports($exception)) {
                return $errorResponder->respond($exception, $request);
            }
        }

        throw new LogicException('a not supported routing exception `' . get_class($exception) . '` was thrown.');
    }

    private function success(RoutingResultInterface $result, ServerRequestInterface $request): ResponseInterface
    {
        foreach ($result->getParams() as $name => $value) {
            $request = $request->withAttribute($name, $value);
        }

        return $result->getHandler()->handle($request);
    }
}
