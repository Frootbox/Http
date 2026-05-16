<?php

namespace Frootbox\Http\Interfaces;

/**
 * Contract for request data accessors.
 */
interface HttpDataInterface {

    /**
     * @param list<string> $attributes
     * @deprecated Use require() on AbstractHttpData implementations instead.
     */
    public function validate ( array $attributes ): \Frootbox\Http\AbstractHttpData;
}
