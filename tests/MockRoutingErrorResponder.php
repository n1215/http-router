<?php
declare(strict_types=1);

namespace N1215\Http\Router;

use N1215\Http\Router\Exception\RoutingException;
use N1215\Http\Router\Handler\RoutingErrorResponderInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\TextResponse;

class MockRoutingErrorResponder implements RoutingErrorResponderInterface
{
    /**
     * @var string
     */
    private $exceptionClass;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @param string $exceptionClass
     * @param int $statusCode
     */
    public function __construct(string $exceptionClass, int $statusCode)
    {
        $this->exceptionClass = $exceptionClass;
        $this->statusCode = $statusCode;
    }

    public function supports(RoutingException $exception): bool
    {
        return $exception instanceof $this->exceptionClass;
    }

    public function respond(RoutingException $exception, ServerRequestInterface $request): ResponseInterface
    {
        return new TextResponse($exception->getMessage(), $this->statusCode);
    }
}
