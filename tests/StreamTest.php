<?php declare(strict_types=1);

namespace Frootbox\Http\Tests;

use Frootbox\Http\Stream;
use PHPUnit\Framework\TestCase;

final class StreamTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->markTestSkipped('Temporarily disabled');
    }

    public function testGetContentsReturnsConstructorBody(): void
    {
        $stream = new Stream('payload');

        $this->assertSame('payload', $stream->getContents());
    }
}
