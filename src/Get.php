<?php
/**
 * @author Jan Habbo Brüning <jan.habbo.bruening@gmail.com>
 *
 * @noinspection PhpUnnecessaryLocalVariableInspection
 * @noinspection PhpFullyQualifiedNameUsageInspection
 */

namespace Frootbox\Http;

class Get extends AbstractHttpData
{
    public function __construct ( )
    {
        $this->data = $_GET;
    }

    /**
     * @param $attribute
     * @param $value
     * @return void
     */
    public function set($attribute, $value): self
    {
        $this->data[$attribute] = $value;

        return $this;
    }
}
