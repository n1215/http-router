<?php
declare(strict_types=1);

namespace N1215\Http\Router;

use Interop\Http\Server\RequestHandlerInterface;

final class RoutingResult implements RoutingResultInterface
{
    /** @var bool  */
    private $isSuccess;

    /** @var RequestHandlerInterface|null  */
    private $matchedHandler;

    /** @var array  */
    private $matchedParams;

    /** @var RoutingErrorInterface|null  */
    private $error;

    private function __construct(
        bool $isSuccess,
        ?RequestHandlerInterface $matchedHandler = null,
        array $matchedParams = [],
        ?RoutingErrorInterface $error = null
    ) {
        $this->isSuccess = $isSuccess;
        $this->matchedHandler = $matchedHandler;
        $this->matchedParams = $matchedParams;
        $this->error = $error;
    }

    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    public function getMatchedHandler(): ?RequestHandlerInterface
    {
        return $this->matchedHandler;
    }

    public function getMatchedParams(): array
    {
        return $this->matchedParams;
    }

    public function getError(): ?RoutingErrorInterface
    {
        return $this->error;
    }

    public static function success(RequestHandlerInterface $matchedHandler, array $matchedParams): self
    {
        return new self(true, $matchedHandler, $matchedParams);
    }

    public static function failure(RoutingErrorInterface $error): self
    {
        return new self(false, null, [], $error);
    }
}
