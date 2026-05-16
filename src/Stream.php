<?php

namespace Frootbox\Http;

/**
 * Lightweight stream wrapper around an in-memory body.
 */
class Stream implements Interfaces\StreamInterface {

    /**
     * @var string|null
     */
    protected $body;


    /**
     * @param string|null $body
     */
    public function __construct ( $body = null ) {

        $this->body = $body;
    }

    public function __toString ( ) {

    }

    public function close ( ) {

    }

    public function detach ( ) {

    }

    public function eof ( ) {

    }

    /**
     * Returns the complete stream contents.
     */
    public function getContents ( ) {

        return $this->body;
    }

    public function getMetadata ( $key = null ) {

    }

    public function getSize ( ) {

    }

    public function isReadable ( ) {

    }

    public function isSeekable ( ) {

    }

    public function isWritable ( ) {

    }

    public function rewind ( ) {

    }

    public function seek ( $offset, $whence = 0 ) {

    }

    public function tell ( ) {

    }

    public function read ( $length ) {

    }

    public function write ( $string ) {

    }
}
