<?php
/**
 *
 */

namespace Frootbox\Http\Interfaces;

interface HttpDataInterface {

    /**
     *
     */
    public function validate ( array $attributes ): \Frootbox\Http\AbstractHttpData;
}