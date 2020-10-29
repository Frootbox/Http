<?php
/**
 *
 */

namespace Frootbox\Http;

class ClientRequest
{
    protected $requestTarget;
    protected $parameters = [ ];

    /**
     *
     */
    public function getRequestTarget ( ): string
    {
        return $this->requestTarget;
    }

    /**
     *
     */
    public function setQueryParameters ( array $parameters ): ClientRequest
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     *
     */
    public function setRequestTarget ( $requestTarget ): ClientRequest
    {
        $this->requestTarget = $requestTarget;

        return $this;
    }
}