<?php

namespace Frootbox\Http;

use Frootbox\Exceptions\InputMissing;

/**
 * Base accessor for HTTP input data.
 */
abstract class AbstractHttpData implements Interfaces\HttpDataInterface
{
    /**
     * @var array<string, mixed>
     */
    protected array $data;

    /**
     * Returns a request value, trimming strings and returning null for missing keys.
     *
     * @param string|int $attribute
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
     * Returns a boolean-like value as 1 or 0 for database fields such as TINYINT(1).
     */
    public function getBinary(string $attribute): int
    {
        return $this->getBoolean($attribute) ? 1 : 0;
    }

    /**
     * Returns whether the trimmed value is not empty.
     */
    public function getBoolean(string $attribute): bool
    {
        return !empty($this->get($attribute));
    }

    /**
     * Returns an integer value or the given default when the value is missing or invalid.
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
     * Reads a nested value by dot-separated path.
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
     * Returns a value or the default when the key is missing.
     *
     * @param string|int $attribute
     * @param mixed $default
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
     * Returns the raw data array.
     *
     * @return array<string, mixed>
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Returns whether the key exists, including keys with null values.
     */
    public function hasAttribute(string $attribute): bool
    {
        return array_key_exists($attribute, $this->data);
    }

    /**
     * @return $this
     *
     * @param list<string> $attributes Dot-separated paths that must exist.
     * @throws InputMissing
     */
    public function require(array $attributes): AbstractHttpData
    {
        foreach ($attributes as $attribute) {

            $sections = explode('.', $attribute);

            $data = $this->data;

            foreach ($sections as $segment) {

                if (!array_key_exists($segment, $data) || (!is_array($data) && strlen($data[$segment]) === 0)) {
                    throw new InputMissing(null, [ 'T:' . $segment ]);
                }

                $data = $data[$segment];
            }
        }

        return $this;
    }

    /**
     * @return $this
     *
     * @param list<string> $attributes Dot-separated paths where at least one must be present.
     * @throws InputMissing
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

        throw new InputMissing('Parameter "' . get_class($this). '->' . $attribute . '" is missing.');
    }

    /**
     * @param list<string> $attributes
     * @deprecated Use require() instead.
     * @see \Frootbox\Http\AbstractHttpData::require()
     */
    public function validate( array $attributes): AbstractHttpData
    {
        return $this->require($attributes);
    }
}
