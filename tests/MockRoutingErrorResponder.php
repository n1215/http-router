<?php
declare(strict_types=1);

namespace N1215\Http\Router;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\TextResponse;

class MockRoutingErrorResponder implements RoutingErrorResponderInterface
{
    public function respond(ServerRequestInterface $request, RoutingErrorInterface $error): ResponseInterface
    {
        return new TextResponse($error->getMessage(), $error->getStatusCode());
    }
}
