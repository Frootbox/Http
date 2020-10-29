<?php 
/**
 * 
 */

namespace Frootbox\Http;

/**
 * 
 */
class Response
{
    protected $statusCode;
    protected $statusReasonPhrase;
    protected $body;
    protected $headers = [ ];

    /**
     * Flush response to output
     */
    public function flush ( ) {

        header($_SERVER['SERVER_PROTOCOL'] . ' ' . $this->getStatusCode() . ' ' . $this->statusReasonPhrase, true, $this->getStatusCode());

        foreach ($this->getHeaders() as $header) {
            header($header['name'] . ':' . $header['value']);
        }

        die($this->getBody()->getContents());
    }



    /**
     * 
     */
    public function getBody ( ) {

        return $this->body;
    }
    
    
    /**
     * 
     */
    public function getHeader ( $name ) {
        
    }
    
    
    /**
     * 
     */
    public function getHeaderLine ( $name ) {
        
    }
    
    
    /**
     * 
     */
    public function getHeaders ( ) {

        return $this->headers;
    }
    
    
    /**
     * 
     */
    public function getProtocolVersion ( ) {
                
    }
    
    
    /**
     * 
     */
    public function getReasonPhrase ( ) {
        
    }
    
    
    /**
     * 
     */
    public function getStatusCode ( ) {
        
    }    
    
    
    /**
     * 
     */
    public function hasHeader ( $name ) {
        
    }
    
    
    /**
     * 
     */
    public function withAddedHeader ( $name, $value ) {
        
    }
    
    
    /**
     * 
     */
    public function withBody ( \Psr\Http\Message\StreamInterface $body ) {

        $this->body = $body;
    }
    
    
    /**
     * 
     */
    public function setHeader ( $name, $value ) {

        $this->headers[] = [
            'name' => $name,
            'value' => $value
        ];

        return $this;
    }
    
    
    /**
     * 
     */
    public function withProtocolVersion ( $version ) {
        
    }
    
    
    /**
     * 
     */
    public function withStatus ( $code, $reasonPhrase = '' ) {
        
        $this->statusCode = $code;
        
        if (empty($reasonPhrase)) {
            
            $phrases = [
                200 => 'OK',
                201 => 'Created',
                202 => 'Accepted',

                401 => 'Unauthorized',
                
                500 => 'Internal Server Error'
            ];
            
            if (!empty($phrases[$code])) {
                $reasonPhrase = $phrases[$code];
            }
        }
        
       
        $this->statusReasonPhrase = $reasonPhrase;
        
        return $this;
    }
    
    
    /**
     * 
     */
    public function withoutHeader ( $name ) {
        
    }
}