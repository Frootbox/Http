<?php 
/**
 * 
 */

namespace Frootbox\Http;

class Get {
    
    protected $data;
    
    /**
     * 
     */
    public function __construct ( ) {
        
        $this->data = $_GET;
    }    
    
    
    /**
     *
     */
    public function get ( $attribute ) {
    
        return !empty($this->data[$attribute]) ? $this->data[$attribute] : null;
    }


    /**
     *
     */
    public function set ( $attribute, $value ) {

        $this->data[$attribute] = $value;

        return $this;
    }
}