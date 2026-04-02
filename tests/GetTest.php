<?php declare(strict_types=1);

namespace Frootbox\Http\Tests;

use Frootbox\Http\Get;
use PHPUnit\Framework\TestCase;

final class GetTest extends TestCase
{
    private array $originalGet = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->originalGet = $_GET;
    }

    protected function tearDown(): void
    {
        $_GET = $this->originalGet;
        parent::tearDown();
    }

    public function testConstructorUsesSuperglobalData(): void
    {
        $_GET = [
            'page' => ' 2 ',
        ];

        $get = new Get();

        $this->assertSame('2', $get->get('page'));
    }

    public function testSetStoresValueAndReturnsSameInstance(): void
    {
        $_GET = [];

        $get = new Get();
        $result = $get->set('sort', 'name');

        $this->assertSame($get, $result);
        $this->assertSame('name', $get->get('sort'));
    }
}
