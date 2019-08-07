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
    public function getData ( ) {

        return $this->data;
    }


    /**
     *
     */
    public function require (  array $attributes ): AbstractHttpData
    {

        foreach ($attributes as $attribute) {

            $sections = explode('.', $attribute);

            $data = $this->data;

            foreach ($sections as $segment) {

                if (empty($data[$segment])) {
                    throw new \Frootbox\Exceptions\InputMissing('Parameter "' . get_class($this). '->' . $attribute . '" is missing.');
                }

                $data = $data[$segment];
            }
        }

        return $this;
    }


    /**
     *
     */
    public function requireOne ( array $attributes ): AbstractHttpData
    {

        foreach ($attributes as $attribute) {

            $sections = explode('.', $attribute);

            $data = $this->data;

            foreach ($sections as $segment) {

                if (!empty($data[$segment])) {
                    return $this;
                }

                $data = $data[$segment];
            }
        }

        throw new \Frootbox\Exceptions\InputMissing('Parameter "' . get_class($this). '->' . $attribute . '" is missing.');
    }


    /**
     * @deprecated
     */
    public function validate (  array $attributes ): AbstractHttpData {

        return $this->require($attributes);
    }
}
