<?php 
/**
 * 
 */

namespace Frootbox\Http;

/**
 * 
 */
class Request implements Interfaces\RequestInterface { 
    
    protected $server;
    
    
    /**
     * 
     */
    public function __construct ( ) {
        
        $this->server = $_SERVER;
                
    }
    
        
    public function getAttribute ( $name, $default = null ) {
    
    }
    
    public function getAttributes ( ) {
    
    }
    
    public function getBody (  ) {
    
    }
    
    public function getQueryParams ( ) {
    
    }
    
    public function getCookieParams ( ) {
    
    }
    
    public function getHeader ( $name ) {
    
    }
    
    public function getHeaderLine ( $name ) {
    
    }
    
    public function getHeaders ( ) {
    
    }
    
    
    /**
     * 
     */
    public function getMethod ( ) {
        
        return $this->server['REQUEST_METHOD'];    
    }
    
    
    public function getParsedBody ( ) {
    
    }
    public function getProtocolVersion ( ) {
    
    }
    public function getRequestTarget ( ) {
    
    }
    
    public function getServerParams ( ) {
        
    }
    
    public function getUploadedFiles ( ) {
    
    }
    public function getUri ( ) {
    
    }
    
    
    /**
     * 
     */
    public function getVirtualPath ( ) {
            
        // Get virtual path
        $virtualPath = str_replace(dirname($_SERVER['SCRIPT_NAME']), '', $_SERVER['REQUEST_URI']);
        
        if ($virtualPath{0} == '/') {
            $virtualPath = substr($virtualPath, 1);
        }
                       
        return explode('?', $virtualPath)[0];
    }
    
    
    /**
     * 
     * @param unknown $name
     */
    public function hasHeader ( $name ) {
    
    }
    
    public function withAddedHeader ( $name, $value ) {
    
    }
    
    public function withAttribute ( $name, $value ) {
    
    }
    
    public function withBody ( \Psr\Http\Message\StreamInterface $body ) {
    
    }
    
    public function withCookieParams ( array $cookies ) {
    
    }
    
    public function withHeader ( $name, $value ) {
    
    }
    
    public function withMethod ( $method ) {
    
    
    }
    public function withParsedBody ( $data ) {
    
    }
    
    public function withQueryParams ( array $query ) {
    
    }
    public function withProtocolVersion ( $version ) {
    
    }
    
    public function withRequestTarget ( $requestTarget ) {
    
    }
    
    
    public function withUploadedFiles ( array $uploadedFiles ) {
    
    }
    public function withUri ( \Psr\Http\Message\UriInterface $uri, $preserveHost = false ) {
    
    }
    public function withoutAttribute ( $name ) {
    
    }
    
    
    public function withoutHeader ( $name ) {
    
    
    }
}