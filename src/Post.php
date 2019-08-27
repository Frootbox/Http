<?php 
/**
 * 
 */

namespace Frootbox\Http;

class Post extends AbstractHttpData {

    /**
     * 
     */
    public function __construct ( )
    {
        $this->data = $_POST;
    }
}