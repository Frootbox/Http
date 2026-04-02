<?php declare(strict_types=1);

namespace Frootbox\Http\Tests;

use Frootbox\Http\Post;
use PHPUnit\Framework\TestCase;

final class PostTest extends TestCase
{
    public function testGetIntWithDefaultReturnsNullWhenKeyIsMissing(): void
    {
        $post = new Post([]);

        $this->assertNull($post->getIntWithDefault('CountryId'));
    }

    public function testGetIntWithDefaultReturnsNullWhenValueIsEmptyString(): void
    {
        $post = new Post([
            'CountryId' => '',
        ]);

        $this->assertNull($post->getIntWithDefault('CountryId'));
    }

    public function testGetIntWithDefaultReturnsIntWhenNumericStringIsGiven(): void
    {
        $post = new Post([
            'CountryId' => '5',
        ]);

        $this->assertSame(5, $post->getIntWithDefault('CountryId'));
    }

    public function testGetIntWithDefaultReturnsZeroWhenValueIsZeroString(): void
    {
        $post = new Post([
            'CountryId' => '0',
        ]);

        $this->assertSame(0, $post->getIntWithDefault('CountryId'));
    }

    public function testGetIntWithDefaultReturnsNullWhenValueIsInvalid(): void
    {
        $post = new Post([
            'CountryId' => 'abc',
        ]);

        $this->assertNull($post->getIntWithDefault('CountryId'));
    }
}