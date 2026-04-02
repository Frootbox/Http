<?php declare(strict_types=1);

namespace Frootbox\Http\Tests;

use Frootbox\Http\Request;
use PHPUnit\Framework\TestCase;

final class RequestTest extends TestCase
{
    private array $originalServer = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->originalServer = $_SERVER;

        $this->markTestSkipped('Temporarily disabled');
    }

    protected function tearDown(): void
    {
        $_SERVER = $this->originalServer;
        parent::tearDown();
    }

    public function testGetMethodReturnsRequestMethodFromServer(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'PATCH';

        $request = new Request();

        $this->assertSame('PATCH', $request->getMethod());
    }

    public function testGetVirtualPathRemovesScriptDirectoryAndQueryString(): void
    {
        $_SERVER['SCRIPT_NAME'] = '/crm/public/index.php';
        $_SERVER['REQUEST_URI'] = '/crm/public/customers/edit?id=5';
        $_SERVER['REQUEST_METHOD'] = 'GET';

        $request = new Request();

        $this->assertSame('customers/edit', $request->getVirtualPath());
    }

    public function testGetVirtualPathReturnsEmptyStringForApplicationRoot(): void
    {
        $_SERVER['SCRIPT_NAME'] = '/crm/public/index.php';
        $_SERVER['REQUEST_URI'] = '/crm/public/?page=1';
        $_SERVER['REQUEST_METHOD'] = 'GET';

        $request = new Request();

        $this->assertSame('', $request->getVirtualPath());
    }
}
