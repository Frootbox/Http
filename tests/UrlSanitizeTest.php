<?php declare(strict_types=1);

namespace Frootbox\Http\Tests;

use Frootbox\Http\Traits\UrlSanitize;
use PHPUnit\Framework\TestCase;

final class UrlSanitizeTest extends TestCase
{
    private function createSanitizer(): object
    {
        return new class {
            use UrlSanitize;
        };
    }

    public function testReturnsNullWhenNothingMeaningfulRemains(): void
    {
        $sanitizer = $this->createSanitizer();

        $this->assertNull($sanitizer->getStringUrlSanitized('---'));
    }

    public function testReturnsNullWhenInputIsNull(): void
    {
        $sanitizer = $this->createSanitizer();

        $this->assertNull($sanitizer->getStringUrlSanitized(null));
    }

    public function testSanitizesGermanSpecialCharactersAndWhitespace(): void
    {
        $sanitizer = $this->createSanitizer();

        $this->assertSame('aepfel-und-oel', $sanitizer->getStringUrlSanitized(' Äpfel & Öl '));
    }

    public function testUsesDutchTranslationForAmpersand(): void
    {
        $sanitizer = $this->createSanitizer();

        $this->assertSame('brood-en-kaas', $sanitizer->getStringUrlSanitized('Brood & Kaas', 'nl-NL'));
    }

    public function testRemovesHtmlAndSpecialCharacters(): void
    {
        $sanitizer = $this->createSanitizer();

        $this->assertSame('hello-world', $sanitizer->getStringUrlSanitized('<b>Hello</b> [br] World? #'));
    }

    public function testTransliteratesSupportedCyrillicCharacters(): void
    {
        $sanitizer = $this->createSanitizer();

        $this->assertSame('moskva', $sanitizer->getStringUrlSanitized('Москва'));
    }


}
