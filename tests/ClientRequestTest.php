<?php declare(strict_types=1);

namespace Frootbox\Http\Tests;

use Frootbox\Http\ClientRequest;
use PHPUnit\Framework\TestCase;

final class ClientRequestTest extends TestCase
{
    public function testRequestTargetCanBeSetAndRead(): void
    {
        $request = new ClientRequest();

        $result = $request->setRequestTarget('/customers');

        $this->assertSame($request, $result);
        $this->assertSame('/customers', $request->getRequestTarget());
    }

    public function testQueryParametersCanBeSetAndRead(): void
    {
        $request = new ClientRequest();

        $result = $request->setQueryParameters([
            'page' => 2,
            'sort' => 'name',
        ]);

        $this->assertSame($request, $result);
        $this->assertSame([
            'page' => 2,
            'sort' => 'name',
        ], $request->getParameters());
    }
}
