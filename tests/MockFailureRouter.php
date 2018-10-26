<?php
declare(strict_types=1);

namespace N1215\Http\Router;

use N1215\Http\Router\Result\RoutingError;
use N1215\Http\Router\Result\RoutingFailure;
use Psr\Http\Message\ServerRequestInterface;

class MockFailureRouter implements RouterInterface
{
    /** @var int  */
    private $statusCode;

    /** @var string  */
    private $message;

    public function __construct(int $statusCode, string $message)
    {
        $this->statusCode = $statusCode;
        $this->message = $message;
    }

    public function match(ServerRequestInterface $request): RoutingResultInterface
    {
        return new RoutingFailure(new RoutingError($this->statusCode, $this->message));
    }
}
