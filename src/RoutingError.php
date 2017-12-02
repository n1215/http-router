<?php
declare(strict_types=1);

namespace N1215\Http\Router;

final class RoutingError implements RoutingErrorInterface
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

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
