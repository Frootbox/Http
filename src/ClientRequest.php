<?php

namespace Frootbox\Http;

/**
 * Mutable value object for outbound client request data.
 */
class ClientRequest
{
    /**
     * @var string|null
     */
    protected $requestTarget;

    /**
     * @var array<string, mixed>
     */
    protected $parameters = [ ];

    /**
     * Returns the request target path or URI.
     */
    public function getRequestTarget(): string
    {
        return $this->requestTarget;
    }

    /**
     * Returns the configured query parameters.
     *
     * @return array<string, mixed>
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * Replaces the query parameters.
     *
     * @param array<string, mixed> $parameters
     */
    public function setQueryParameters(array $parameters): ClientRequest
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * Sets the request target path or URI.
     */
    public function setRequestTarget($requestTarget): ClientRequest
    {
        $this->requestTarget = $requestTarget;

        return $this;
    }
}
