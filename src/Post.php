<?php
/**
 * @author Jan Habbo Brüning <jan.habbo.bruening@gmail.com>
 *
 * @noinspection PhpUnnecessaryLocalVariableInspection
 * @noinspection PhpFullyQualifiedNameUsageInspection
 */

namespace Frootbox\Http;

class Post extends AbstractHttpData
{
    public function __construct(array $post = null)
    {
        $this->data = $post ?? $_POST;
    }
}
