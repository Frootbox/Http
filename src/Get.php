<?php 
/**
 * 
 */

namespace Frootbox\Http;

class Get extends AbstractHttpData
{
    /**
     * 
     */
    public function __construct ( )
    {
        $this->data = $_GET;
    }

    /**
     *
     */
    public function set($attribute, $value)
    {
        $this->data[$attribute] = $value;

        return $this;
    }
}
