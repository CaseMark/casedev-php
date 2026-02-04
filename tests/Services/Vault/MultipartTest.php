<?php

namespace Tests\Services\Vault;

use Casedev\Client;
use Casedev\Core\Util;
use Casedev\Vault\Multipart\MultipartGetPartURLsResponse;
use Casedev\Vault\Multipart\MultipartInitResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class MultipartTest extends TestCase
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
    public function testAbort(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->multipart->abort(
            'id',
            objectID: 'objectId',
            uploadID: 'uploadId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testAbortWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->multipart->abort(
            'id',
            objectID: 'objectId',
            uploadID: 'uploadId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testComplete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->multipart->complete(
            'id',
            objectID: 'objectId',
            parts: [['etag' => 'etag', 'partNumber' => 1]],
            sizeBytes: 1,
            uploadID: 'uploadId',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCompleteWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->multipart->complete(
            'id',
            objectID: 'objectId',
            parts: [['etag' => 'etag', 'partNumber' => 1]],
            sizeBytes: 1,
            uploadID: 'uploadId',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testGetPartURLs(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->multipart->getPartURLs(
            'id',
            objectID: 'objectId',
            parts: [['partNumber' => 1, 'sizeBytes' => 1]],
            uploadID: 'uploadId',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MultipartGetPartURLsResponse::class, $result);
    }

    #[Test]
    public function testGetPartURLsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->multipart->getPartURLs(
            'id',
            objectID: 'objectId',
            parts: [['partNumber' => 1, 'sizeBytes' => 1]],
            uploadID: 'uploadId',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MultipartGetPartURLsResponse::class, $result);
    }

    #[Test]
    public function testInit(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->multipart->init(
            'id',
            contentType: 'contentType',
            filename: 'filename',
            sizeBytes: 1
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MultipartInitResponse::class, $result);
    }

    #[Test]
    public function testInitWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->multipart->init(
            'id',
            contentType: 'contentType',
            filename: 'filename',
            sizeBytes: 1,
            autoIndex: true,
            metadata: (object) [],
            partSizeBytes: 5242880,
            path: 'path',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MultipartInitResponse::class, $result);
    }
}
