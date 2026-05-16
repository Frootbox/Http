<?php

namespace Frootbox\Http\Interfaces;

/**
 * Server request with access to the application-relative virtual path.
 */
interface RequestInterface extends \Psr\Http\Message\ServerRequestInterface {


    /**
     * Returns the request path relative to the script directory.
     */
    public function getVirtualPath ( );
}
