<?php 
/**
 * 
 */

namespace Frootbox\Http\Interfaces;

interface RequestInterface extends \Psr\Http\Message\ServerRequestInterface {
    
    
    /**
     * 
     */
    public function getVirtualPath ( );
}