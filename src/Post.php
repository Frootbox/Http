<?php

namespace Frootbox\Http;

/**
 * Accessor for POST data.
 */
class Post extends AbstractHttpData
{
    public function __construct(array $post = null)
    {
        $this->data = $post ?? $_POST;
    }
}
