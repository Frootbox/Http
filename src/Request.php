<?php

namespace Frootbox\Http;

/**
 * Partial server request wrapper backed by PHP superglobals.
 */
class Request implements Interfaces\RequestInterface {

    protected $server;

    /**
     * Captures the current server environment.
     */
    public function __construct ( ) {

        $this->server = $_SERVER;

    }

    public function getAttribute($name, $default = null)
    {

    }

    public function getAttributes(): array
    {

    }

    public function getBody(): \Psr\Http\Message\StreamInterface
    {

    }

    public function getQueryParams(): array
    {

    }

    public function getCookieParams(): array
    {

    }

    public function getHeader(string $name): array
    {

    }

    public function getHeaderLine(string $name): string
    {

    }

    public function getHeaders(): array
    {

    }

    public function getMethod(): string
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function getParsedBody ( ) {

    }

    public function getProtocolVersion(): string
    {

    }

    public function getRequestTarget(): string
    {

    }

    public function getServerParams(): array
    {

    }

    public function getUploadedFiles(): array
    {

    }

    public function getUri(): \Psr\Http\Message\UriInterface
    {

    }

    /**
     * Returns the request path relative to the script directory.
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

    public function hasHeader(string $name): bool
    {

    }

    public function withAddedHeader(string $name, $value): \Psr\Http\Message\ResponseInterface
    {

    }

    public function withAttribute(string $name, $value): \Psr\Http\Message\ServerRequestInterface
    {

    }

    public function withBody ( \Psr\Http\Message\StreamInterface $body): \Psr\Http\Message\MessageInterface
    {

    }

    public function withCookieParams(array $cookies): \Psr\Http\Message\ServerRequestInterface
    {

    }

    public function withHeader(string $name, $value): \Psr\Http\Message\ServerRequestInterface
    {

    }

    public function withMethod(string $method): \Psr\Http\Message\RequestInterface
    {

    }

    public function withParsedBody($data): \Psr\Http\Message\ServerRequestInterface
    {

    }

    public function withQueryParams(array $query): \Psr\Http\Message\ServerRequestInterface
    {

    }

    public function withProtocolVersion(string $version): \Psr\Http\Message\ServerRequestInterface
    {

    }

    public function withRequestTarget($requestTarget): \Psr\Http\Message\RequestInterface
    {

    }

    public function withUploadedFiles(array $uploadedFiles): \Psr\Http\Message\ServerRequestInterface
    {

    }

    public function withUri(\Psr\Http\Message\UriInterface $uri, $preserveHost = false): \Psr\Http\Message\RequestInterface
    {

    }

    public function withoutAttribute(string $name): \Psr\Http\Message\ServerRequestInterface
    {

    }

    public function withoutHeader(string $name): \Psr\Http\Message\ServerRequestInterface
    {

    }
}
