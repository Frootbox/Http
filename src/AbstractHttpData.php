<?php
/**
 * @author Jan Habbo Brüning <jan.habbo.bruening@gmail.com>
 *
 * @noinspection PhpUnnecessaryLocalVariableInspection
 * @noinspection PhpFullyQualifiedNameUsageInspection
 */

namespace Frootbox\Http;

abstract class AbstractHttpData implements Interfaces\HttpDataInterface
{
    protected array $data;

    /**
     * Get value of post/get/xxx variable
     *
     * @param $attribute
     * @return mixed|string|null
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
     * Returns 1 oder 0 if result is boolean true or false
     *
     * This is a helper function to simplify storing booleans in sql via TINYINT(1)
     *
     * @param string $attribute
     * @return int
     */
    public function getBinary(string $attribute): int
    {
        return $this->getBoolean($attribute) ? 1 : 0;
    }

    /**
     * Get value as boolean
     *
     * @param string $attribute
     * @return bool
     */
    public function getBoolean(string $attribute): bool
    {
        return !empty($this->get($attribute));
    }

    /**
     * @param string $attribute
     * @param int|null $default
     * @return int|null
     */
    public function getIntWithDefault(string $attribute, ?int $default = null): ?int
    {
        // Return default if attribute does not exist
        if (!array_key_exists($attribute, $this->data)) {
            return $default;
        }

        $value = $this->get($attribute);

        if ($value === null || $value === '') {
            return $default;
        }

        if (filter_var($value, FILTER_VALIDATE_INT) === false) {
            return $default;
        }

        return (int) $value;
    }

    /**
     * @param string $path
     * @return array|mixed|null
     */
    public function getPath(string $path)
    {
        $request = explode('.', $path);

        $data = $this->data;

        foreach ($request as $segment) {

            if (!isset($data[$segment]) or $data[$segment] === null) {
                return null;
            }

            if (is_array($data[$segment])) {
                $data = $data[$segment];
                continue;
            }

            return $data[$segment];
        }

        return $data;
    }

    /**
     * @param $attribute
     * @param $default
     * @return mixed|string|null
     */
    public function getWithDefault($attribute, $default = null): mixed
    {
        // Return default if attribute does not exist
        if (!array_key_exists($attribute, $this->data)) {
            return $default;
        }

        return $this->get($attribute);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param string $attribute
     * @return bool
     */
    public function hasAttribute(string $attribute): bool
    {
        return array_key_exists($attribute, $this->data);
    }

    /**
     * @param array $attributes
     * @return $this
     * @throws \Frootbox\Exceptions\InputMissing
     */
    public function require(array $attributes): AbstractHttpData
    {
        foreach ($attributes as $attribute) {

            $sections = explode('.', $attribute);

            $data = $this->data;

            foreach ($sections as $segment) {

                if (!array_key_exists($segment, $data) || (!is_array($data) && strlen($data[$segment]) === 0)) {
                    throw new \Frootbox\Exceptions\InputMissing(null, [ 'T:' . $segment ]);
                }

                $data = $data[$segment];
            }
        }

        return $this;
    }

    /**
     * @param array $attributes
     * @return $this
     * @throws \Frootbox\Exceptions\InputMissing
     */
    public function requireOne(
        array $attributes
    ): AbstractHttpData
    {
        foreach ($attributes as $attribute) {
            $sections = explode('.', $attribute);
            $data = $this->data;
            $pathExists = true;

            foreach ($sections as $segment) {

                if (!is_array($data) || !array_key_exists($segment, $data)) {
                    $pathExists = false;
                    break;
                }

                $data = $data[$segment];
            }

            if ($pathExists && ((is_array($data) && !empty($data)) || (!is_array($data) && strlen($data) > 0))) {
                return $this;
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
