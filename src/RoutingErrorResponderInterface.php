<?php
declare(strict_types=1);

namespace N1215\Http\Router;

use Psr\Http\Message\ResponseInterface;

interface RoutingErrorResponderInterface
{
    public function respond(RoutingErrorInterface $error): ResponseInterface;
}
