<?php

namespace Tests\Services\Ocr;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Router\Client;
use Router\Core\Util;
use Router\Ocr\V1\V1GetResponse;
use Router\Ocr\V1\V1ProcessResponse;
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
    public function testRetrieve(): void
    {
        $result = $this->client->ocr->v1->retrieve('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1GetResponse::class, $result);
    }

    #[Test]
    public function testDownload(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server doesn\'t support application/octet-stream responses');
        }

        $result = $this->client->ocr->v1->download('text', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsString($result);
    }

    #[Test]
    public function testDownloadWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server doesn\'t support application/octet-stream responses');
        }

        $result = $this->client->ocr->v1->download('text', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsString($result);
    }

    #[Test]
    public function testProcess(): void
    {
        $result = $this->client->ocr->v1->process(
            documentURL: 'https://example.com/contract.pdf'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1ProcessResponse::class, $result);
    }

    #[Test]
    public function testProcessWithOptionalParams(): void
    {
        $result = $this->client->ocr->v1->process(
            documentURL: 'https://example.com/contract.pdf',
            callbackURL: 'https://your-app.com/webhooks/ocr-complete',
            documentID: 'contract-2024-001',
            engine: 'doctr',
            features: [
                'embed' => [],
                'forms' => ['foo' => 'bar'],
                'tables' => ['format' => 'csv'],
            ],
            resultBucket: 'my-ocr-results',
            resultPrefix: 'ocr/2024/',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1ProcessResponse::class, $result);
    }
}
