<?php declare(strict_types=1);

namespace Frootbox\Http\Tests;

use Frootbox\Exceptions\InputMissing;
use Frootbox\Http\AbstractHttpData;
use PHPUnit\Framework\TestCase;

final class AbstractHttpDataTest extends TestCase
{
    private function createHttpData(array $data): AbstractHttpData
    {
        return new class($data) extends AbstractHttpData {
            public function __construct(array $data)
            {
                $this->data = $data;
            }
        };
    }

    public function testGetReturnsNullWhenAttributeIsMissing(): void
    {
        $httpData = $this->createHttpData([]);

        $this->assertNull($httpData->get('Title'));
    }

    public function testGetTrimsStringValues(): void
    {
        $httpData = $this->createHttpData([
            'Title' => '  Example Title  ',
        ]);

        $this->assertSame('Example Title', $httpData->get('Title'));
    }

    public function testGetReturnsNonStringValuesUnchanged(): void
    {
        $httpData = $this->createHttpData([
            'Count' => 5,
            'Enabled' => true,
            'Items' => ['a', 'b'],
        ]);

        $this->assertSame(5, $httpData->get('Count'));
        $this->assertTrue($httpData->get('Enabled'));
        $this->assertSame(['a', 'b'], $httpData->get('Items'));
    }

    public function testGetBinaryReturnsOneForTruthyValues(): void
    {
        $httpData = $this->createHttpData([
            'Enabled' => 'yes',
        ]);

        $this->assertSame(1, $httpData->getBinary('Enabled'));
    }

    public function testGetBinaryReturnsZeroForFalsyValues(): void
    {
        $httpData = $this->createHttpData([
            'Enabled' => '',
            'Disabled' => '0',
        ]);

        $this->assertSame(0, $httpData->getBinary('Enabled'));
        $this->assertSame(0, $httpData->getBinary('Disabled'));
        $this->assertSame(0, $httpData->getBinary('Missing'));
    }

    public function testGetBooleanReturnsExpectedValues(): void
    {
        $httpData = $this->createHttpData([
            'Truthy' => '1',
            'Whitespace' => '   ',
            'ZeroString' => '0',
            'ZeroInt' => 0,
            'EmptyString' => '',
        ]);

        $this->assertTrue($httpData->getBoolean('Truthy'));
        $this->assertFalse($httpData->getBoolean('Whitespace'));
        $this->assertFalse($httpData->getBoolean('ZeroString'));
        $this->assertFalse($httpData->getBoolean('ZeroInt'));
        $this->assertFalse($httpData->getBoolean('EmptyString'));
        $this->assertFalse($httpData->getBoolean('Missing'));
    }

    public function testGetIntWithDefaultReturnsProvidedDefaultWhenAttributeIsMissing(): void
    {
        $httpData = $this->createHttpData([]);

        $this->assertSame(99, $httpData->getIntWithDefault('CountryId', 99));
    }

    public function testGetIntWithDefaultReturnsNegativeIntegerWhenValueIsValid(): void
    {
        $httpData = $this->createHttpData([
            'Offset' => '-7',
        ]);

        $this->assertSame(-7, $httpData->getIntWithDefault('Offset'));
    }

    public function testGetIntWithDefaultReturnsDefaultWhenValueIsInvalid(): void
    {
        $httpData = $this->createHttpData([
            'CountryId' => '12.5',
        ]);

        $this->assertSame(42, $httpData->getIntWithDefault('CountryId', 42));
    }

    public function testGetPathReturnsNestedScalarValue(): void
    {
        $httpData = $this->createHttpData([
            'Address' => [
                'Contact' => [
                    'Email' => 'john@example.com',
                ],
            ],
        ]);

        $this->assertSame('john@example.com', $httpData->getPath('Address.Contact.Email'));
    }

    public function testGetPathReturnsNestedArrayWhenPathEndsOnArray(): void
    {
        $httpData = $this->createHttpData([
            'Address' => [
                'Contact' => [
                    'Email' => 'john@example.com',
                ],
            ],
        ]);

        $this->assertSame([
            'Email' => 'john@example.com',
        ], $httpData->getPath('Address.Contact'));
    }

    public function testGetPathReturnsNullWhenSegmentIsMissing(): void
    {
        $httpData = $this->createHttpData([
            'Address' => [
                'Contact' => null,
            ],
        ]);

        $this->assertNull($httpData->getPath('Address.Contact.Email'));
        $this->assertNull($httpData->getPath('Address.City'));
    }

    public function testGetWithDefaultReturnsDefaultWhenAttributeIsMissing(): void
    {
        $httpData = $this->createHttpData([]);

        $this->assertSame('fallback', $httpData->getWithDefault('Title', 'fallback'));
    }

    public function testGetWithDefaultReturnsTrimmedValueWhenAttributeExists(): void
    {
        $httpData = $this->createHttpData([
            'Title' => '  Example  ',
        ]);

        $this->assertSame('Example', $httpData->getWithDefault('Title', 'fallback'));
    }

    public function testGetDataReturnsOriginalInternalData(): void
    {
        $data = [
            'Title' => '  Example  ',
            'Enabled' => '1',
        ];

        $httpData = $this->createHttpData($data);

        $this->assertSame($data, $httpData->getData());
    }

    public function testHasAttributeReturnsTrueForExistingNullAttribute(): void
    {
        $httpData = $this->createHttpData([
            'Title' => null,
        ]);

        $this->assertTrue($httpData->hasAttribute('Title'));
        $this->assertFalse($httpData->hasAttribute('Missing'));
    }

    public function testRequireAcceptsZeroAsPresentValue(): void
    {
        $httpData = $this->createHttpData([
            'Address' => [],
            'Count' => '0',
        ]);

        $this->assertSame($httpData, $httpData->require(['Count']));
    }

    public function testRequireReturnsSameInstanceWhenAllRequiredAttributesExist(): void
    {
        $httpData = $this->createHttpData([
            'Title' => 'Example',
            'Address' => [
                'City' => 'Amsterdam',
            ],
        ]);

        $this->assertSame($httpData, $httpData->require(['Title', 'Address.City']));
    }

    public function testRequireThrowsExceptionWhenRequiredAttributeIsMissing(): void
    {
        $httpData = $this->createHttpData([
            'Address' => [],
        ]);

        $this->expectException(InputMissing::class);

        $httpData->require(['Address.City']);
    }

    public function testRequireOneReturnsSameInstanceWhenAnyAttributeExists(): void
    {
        $httpData = $this->createHttpData([
            'Address' => [
                'City' => 'Amsterdam',
            ],
        ]);

        $this->assertSame($httpData, $httpData->requireOne(['Title', 'Address.City']));
    }

    public function testRequireOneThrowsExceptionWhenNoAttributeExists(): void
    {
        $httpData = $this->createHttpData([
            'Title' => '',
            'Address' => [
                'City' => '',
            ],
        ]);

        $this->expectException(InputMissing::class);

        $httpData->requireOne(['Title', 'Address.City']);
    }

    public function testValidateDelegatesToRequire(): void
    {
        $httpData = $this->createHttpData([
            'Title' => 'Example',
        ]);

        $this->assertSame($httpData, $httpData->validate(['Title']));
    }

    public function testRequireOneAcceptsZeroAsPresentNestedValue(): void
    {
        $httpData = $this->createHttpData([
            'Address' => [
                'CountryId' => '0',
            ],
        ]);

        $this->assertSame($httpData, $httpData->requireOne(['Title', 'Address.CountryId']));
    }

}
