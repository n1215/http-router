<?php
declare(strict_types=1);

namespace N1215\Http\Router;

use N1215\Http\Router\Exception\RoutingException;
use Psr\Http\Message\ServerRequestInterface;

interface RouterInterface
{
    /**
     * @param ServerRequestInterface $request
     * @return RoutingResultInterface
     * @throws RoutingException
     */
    public function match(ServerRequestInterface $request) : RoutingResultInterface;
}
