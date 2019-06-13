<?php
/**
 *
 */

namespace Frootbox\Http;

abstract class AbstractHttpData implements Interfaces\HttpDataInterface {

    protected $data;

    /**
     *
     */
    public function get ( $attribute ) {

        return !empty($this->data[$attribute]) ? $this->data[$attribute] : null;
    }


    /**
     *
     */
    public function validate (  array $attributes ): AbstractHttpData {

        foreach ($attributes as $attribute) {

            if (empty($this->data[$attribute])) {
                throw new \Frootbox\Exceptions\InputMissing('Parameter "' . get_class($this). '->' . $attribute . '" is missing.');
            }
        }

        return $this;
    }
}
