<?php
declare(strict_types=1);

namespace N1215\Http\Router\Handler;

use N1215\Http\Router\Exception\RoutingException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface RoutingErrorResponderInterface
{
    public function supports(RoutingException $exception): bool;

    public function respond(RoutingException $exception,  ServerRequestInterface $request): ResponseInterface;
}
