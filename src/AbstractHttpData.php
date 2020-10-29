<?php
/**
 *
 */

namespace Frootbox\Http;

abstract class AbstractHttpData implements Interfaces\HttpDataInterface
{
    protected $data;

    /**
     * Get value of post/get/xxx variable
     */
    public function get($attribute)
    {
        // Return null if attribute does not exist
        if (!array_key_exists($attribute, $this->data)) {
            return null;
        }

        // Trim whitespaces off value if it is a string
        if (is_string($this->data[$attribute])) {
            return trim($this->data[$attribute]);
        }

        return $this->data[$attribute];
    }

    /**
     *
     */
    public function getWithDefault ( $attribute, $default )
    {

        // Return default if attribute does not exist
        if (empty($this->data[$attribute])) {
            return $default;
        }

        return $this->get($attribute);
    }

    /**
     *
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     *
     */
    public function require(array $attributes): AbstractHttpData
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
    public function requireOne(
        array $attributes
    ): AbstractHttpData
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
     * @see \Frootbox\Http\AbstractHttpData::require()
     */
    public function validate( array $attributes): AbstractHttpData
    {
        return $this->require($attributes);
    }
}
