<?php declare(strict_types=1);

namespace Frootbox\Http\Tests;

use Frootbox\Http\Response;
use PHPUnit\Framework\TestCase;

final class ResponseTest extends TestCase
{
    public function testSetBodyTrimsBodyBeforeStoringIt(): void
    {
        $response = new Response();
        $response->setBody('  Hello World  ');

        $this->assertSame('Hello World', $response->getBody());
    }

    public function testSetHeaderAppendsHeaderAndReturnsSameInstance(): void
    {
        $response = new Response();

        $result = $response->setHeader('Content-Type', 'application/json');

        $this->assertSame($response, $result);
        $this->assertSame([
            [
                'name' => 'Content-Type',
                'value' => 'application/json',
            ],
        ], $response->getHeaders());
    }

    public function testWithStatusSetsKnownDefaultReasonPhrase(): void
    {
        $response = new Response();
        $result = $response->withStatus(201);

        $this->assertSame($response, $result);

        $reflection = new \ReflectionClass($response);
        $statusCodeProperty = $reflection->getProperty('statusCode');
        $statusReasonPhraseProperty = $reflection->getProperty('statusReasonPhrase');

        $this->assertSame(201, $statusCodeProperty->getValue($response));
        $this->assertSame('Created', $statusReasonPhraseProperty->getValue($response));
    }

    public function testWithStatusUsesExplicitReasonPhraseWhenProvided(): void
    {
        $response = new Response();
        $response->withStatus(418, 'I am a teapot');

        $reflection = new \ReflectionClass($response);
        $statusCodeProperty = $reflection->getProperty('statusCode');
        $statusReasonPhraseProperty = $reflection->getProperty('statusReasonPhrase');

        $this->assertSame(418, $statusCodeProperty->getValue($response));
        $this->assertSame('I am a teapot', $statusReasonPhraseProperty->getValue($response));
    }
}
