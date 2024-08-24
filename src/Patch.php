<?php 
/**
 * 
 */

namespace Frootbox\Http;

class Patch extends AbstractHttpData
{
    /**
     *
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
