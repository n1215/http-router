<?php
declare(strict_types=1);

namespace N1215\Http\Router;

interface RoutingErrorInterface
{
    public function getStatusCode(): int;

    public function getMessage(): string;
}
