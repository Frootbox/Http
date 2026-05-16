<?php

namespace Frootbox\Http;

/**
 * Accessor for query string data.
 */
class Get extends AbstractHttpData
{
    public function __construct ( )
    {
        $this->data = $_GET;
    }

    /**
     * Stores a query value and returns the current instance.
     *
     * @param string|int $attribute
     * @param mixed $value
     */
    public function set($attribute, $value): self
    {
        $this->data[$attribute] = $value;

        return $this;
    }
}
