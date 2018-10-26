<?php
declare(strict_types=1);

namespace N1215\Http\Router;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class MockRequestHandler implements RequestHandlerInterface
{
    /** @var ResponseInterface */
    private $handler;

    public function __construct(callable $handler)
    {
        $this->handler = $handler;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return \call_user_func($this->handler, $request);
    }
}
