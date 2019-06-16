<?php
declare(strict_types=1);

namespace N1215\Http\Router;

use N1215\Http\Router\Exception\RoutingException;
use Psr\Http\Message\ServerRequestInterface;

class MockFailureRouter implements RouterInterface
{
    /**
     * @var RoutingException
     */
    private $exception;

    public function __construct(RoutingException $exception)
    {
        $this->exception = $exception;
    }

    public function match(ServerRequestInterface $request): RoutingResultInterface
    {
        throw $this->exception;
    }
}
