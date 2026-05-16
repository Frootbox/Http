<?php

namespace Frootbox\Http;

/**
 * Accessor for URL-encoded PATCH request data.
 */
class Patch extends AbstractHttpData
{
    /**
     * Parses the request body into the internal data array.
     */
    public function __construct ( )
    {
        parse_str(file_get_contents('php://input'), $patchData);

        if (empty($patchData)) {
            $patchData = [];
        }

        $this->data = $patchData;
    }
}
