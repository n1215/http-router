<?php
declare(strict_types=1);

namespace N1215\Http\Router;

interface RoutingErrorResponderInterface
{
    public function respond(RoutingErrorInterface $error): int;
}
