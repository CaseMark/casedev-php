<?php

namespace Tests\Services\Superdoc;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Router\Client;
use Router\Core\Util;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class V1Test extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testAnnotate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server doesn\'t support application/pdf responses');
        }

        $result = $this->client->superdoc->v1->annotate(
            document: [],
            fields: [['type' => 'text', 'value' => 'string']]
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsString($result);
    }

    #[Test]
    public function testAnnotateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server doesn\'t support application/pdf responses');
        }

        $result = $this->client->superdoc->v1->annotate(
            document: ['base64' => 'base64', 'url' => 'url'],
            fields: [
                [
                    'type' => 'text',
                    'value' => 'string',
                    'id' => 'id',
                    'group' => 'group',
                    'options' => ['height' => 0, 'width' => 0],
                ],
            ],
            outputFormat: 'docx',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsString($result);
    }

    #[Test]
    public function testConvert(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server doesn\'t support application/pdf responses');
        }

        $result = $this->client->superdoc->v1->convert(from: 'docx');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsString($result);
    }

    #[Test]
    public function testConvertWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server doesn\'t support application/pdf responses');
        }

        $result = $this->client->superdoc->v1->convert(
            from: 'docx',
            documentBase64: 'document_base64',
            documentURL: 'document_url',
            to: 'pdf',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsString($result);
    }
}
