<?php

namespace Frootbox\Http;

/**
 * Lightweight mutable HTTP response.
 */
class Response
{
    /**
     * @var int|null
     */
    protected $statusCode;

    /**
     * @var string|null
     */
    protected $statusReasonPhrase;

    /**
     * @var string|null
     */
    protected $body;

    /**
     * @var list<array{name: string, value: string}>
     */
    protected $headers = [ ];

    /**
     * Sends headers and body, then terminates the script.
     */
    public function flush ( ) {

        header($_SERVER['SERVER_PROTOCOL'] . ' ' . $this->getStatusCode() . ' ' . $this->statusReasonPhrase, true, $this->getStatusCode());

        foreach ($this->getHeaders() as $header) {
            header($header['name'] . ':' . $header['value']);
        }

        $body = $this->getBody();

        if (is_string($body)) {
            die($body);
        }

        die($body->getContents());
    }

    /**
     * Returns the response body.
     */
    public function getBody ( ): string
    {

        return $this->body;
    }

    public function getHeader ( $name ) {

    }

    public function getHeaderLine ( $name ) {

    }

    /**
     * Returns all configured headers.
     *
     * @return list<array{name: string, value: string}>
     */
    public function getHeaders ( ) {

        return $this->headers;
    }

    public function getReasonPhrase ( ) {

    }

    public function getStatusCode ( ) {

    }

    public function hasHeader ( $name ) {

    }

    public function withAddedHeader ( $name, $value ) {

    }

    /**
     * Stores the trimmed response body.
     */
    public function setBody ( string $body ) {

        $this->body = trim($body);
    }

    /**
     * Appends a header and returns the current response.
     */
    public function setHeader ( $name, $value ) {

        $this->headers[] = [
            'name' => $name,
            'value' => $value
        ];

        return $this;
    }

    /**
     * Sets the HTTP status code and optional reason phrase.
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

    public function withoutHeader ( $name ) {

    }
}
