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

    /**
     * @param $name
     * @param $default
     * @return void
     */
    public function getAttribute($name, $default = null)
    {
    
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
    
    }

    /**
     * @return \Psr\Http\Message\StreamInterface
     */
    public function getBody(): \Psr\Http\Message\StreamInterface
    {
    
    }

    /**
     * @return array
     */
    public function getQueryParams(): array
    {
    
    }

    /**
     * @return array
     */
    public function getCookieParams(): array
    {
    
    }

    /**
     * @param string $name
     * @return array|string[]
     */
    public function getHeader(string $name): array
    {
    
    }

    /**
     * @param string $name
     * @return string
     */
    public function getHeaderLine(string $name): string
    {
    
    }

    /**
     * @return array|\string[][]
     */
    public function getHeaders(): array
    {
    
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->server['REQUEST_METHOD'];    
    }

    /**
     * @return void
     */
    public function getParsedBody ( ) {
    
    }

    /**
     * @return string
     */
    public function getProtocolVersion(): string
    {
    
    }

    /**
     * @return string
     */
    public function getRequestTarget(): string
    {
    
    }

    /**
     * @return array
     */
    public function getServerParams(): array
    {
        
    }

    /**
     * @return array
     */
    public function getUploadedFiles(): array
    {
    
    }

    /**
     * @return \Psr\Http\Message\UriInterface
     */
    public function getUri(): \Psr\Http\Message\UriInterface
    {
    
    }

    /**
     * 
     */
    public function getVirtualPath()
    {
        // Get virtual path
        $virtualPath = str_replace(dirname($_SERVER['SCRIPT_NAME']), '', $_SERVER['REQUEST_URI']);
        
        if ($virtualPath[0] == '/') {
            $virtualPath = substr($virtualPath, 1);
        }
                       
        return explode('?', $virtualPath)[0];
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasHeader(string $name): bool
    {
    
    }

    /**
     * @param string $name
     * @param $value
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function withAddedHeader(string $name, $value): \Psr\Http\Message\ResponseInterface
    {
    
    }

    /**
     * @param string $name
     * @param $value
     * @return \Psr\Http\Message\ServerRequestInterface
     */
    public function withAttribute(string $name, $value): \Psr\Http\Message\ServerRequestInterface
    {
    
    }

    /**
     * @param \Psr\Http\Message\StreamInterface $body
     * @return \Psr\Http\Message\MessageInterface
     */
    public function withBody ( \Psr\Http\Message\StreamInterface $body): \Psr\Http\Message\MessageInterface
    {
    
    }

    /**
     * @param array $cookies
     * @return \Psr\Http\Message\ServerRequestInterface
     */
    public function withCookieParams(array $cookies): \Psr\Http\Message\ServerRequestInterface
    {
    
    }

    /**
     * @param string $name
     * @param $value
     * @return \Psr\Http\Message\ServerRequestInterface
     */
    public function withHeader(string $name, $value): \Psr\Http\Message\ServerRequestInterface
    {
    
    }

    /**
     * @param string $method
     * @return \Psr\Http\Message\RequestInterface
     */
    public function withMethod(string $method): \Psr\Http\Message\RequestInterface
    {
    
    }

    /**
     * @param $data
     * @return \Psr\Http\Message\ServerRequestInterface
     */
    public function withParsedBody($data): \Psr\Http\Message\ServerRequestInterface
    {
    
    }

    /**
     * @param array $query
     * @return \Psr\Http\Message\ServerRequestInterface
     */
    public function withQueryParams(array $query): \Psr\Http\Message\ServerRequestInterface
    {
    
    }

    /**
     * @param string $version
     * @return \Psr\Http\Message\ServerRequestInterface
     */
    public function withProtocolVersion(string $version): \Psr\Http\Message\ServerRequestInterface
    {
    
    }

    /**
     * @param $requestTarget
     * @return \Psr\Http\Message\RequestInterface
     */
    public function withRequestTarget($requestTarget): \Psr\Http\Message\RequestInterface
    {
    
    }

    /**
     * @param array $uploadedFiles
     * @return \Psr\Http\Message\ServerRequestInterface
     */
    public function withUploadedFiles(array $uploadedFiles): \Psr\Http\Message\ServerRequestInterface
    {
    
    }

    /**
     * @param \Psr\Http\Message\UriInterface $uri
     * @param $preserveHost
     * @return \Psr\Http\Message\RequestInterface
     */
    public function withUri(\Psr\Http\Message\UriInterface $uri, $preserveHost = false): \Psr\Http\Message\RequestInterface
    {
    
    }

    /**
     * @param string $name
     * @return \Psr\Http\Message\ServerRequestInterfac
     */
    public function withoutAttribute(string $name): \Psr\Http\Message\ServerRequestInterface
    {
    
    }

    /**
     * @param string $name
     * @return \Psr\Http\Message\ServerRequestInterface
     */
    public function withoutHeader(string $name): \Psr\Http\Message\ServerRequestInterface
    {
    
    }
}
