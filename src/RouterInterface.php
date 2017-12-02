<?php
declare(strict_types=1);

namespace N1215\Http\Router;

use Psr\Http\Message\ServerRequestInterface;

interface RouterInterface
{
    public function match(ServerRequestInterface $request) : RoutingResultInterface;
}
