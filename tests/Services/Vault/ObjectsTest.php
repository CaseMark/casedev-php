<?php

namespace Tests\Services\Vault;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Router\Client;
use Router\Core\Util;
use Router\Vault\Objects\ObjectDeleteResponse;
use Router\Vault\Objects\ObjectGetOcrWordsResponse;
use Router\Vault\Objects\ObjectGetResponse;
use Router\Vault\Objects\ObjectGetSummarizeJobResponse;
use Router\Vault\Objects\ObjectGetTextResponse;
use Router\Vault\Objects\ObjectListResponse;
use Router\Vault\Objects\ObjectNewPresignedURLResponse;
use Router\Vault\Objects\ObjectUpdateResponse;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class ObjectsTest extends TestCase
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
        $result = $this->client->vault->objects->retrieve('objectId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectGetResponse::class, $result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        $result = $this->client->vault->objects->retrieve('objectId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectGetResponse::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->vault->objects->update('objectId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectUpdateResponse::class, $result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        $result = $this->client->vault->objects->update(
            'objectId',
            id: 'id',
            filename: 'deposition-smith-2024.pdf',
            metadata: (object) [],
            path: '/Discovery/Depositions',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectUpdateResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->vault->objects->list('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectListResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->vault->objects->delete('objectId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectDeleteResponse::class, $result);
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        $result = $this->client->vault->objects->delete(
            'objectId',
            id: 'id',
            force: 'true'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectDeleteResponse::class, $result);
    }

    #[Test]
    public function testCreatePresignedURL(): void
    {
        $result = $this->client->vault->objects->createPresignedURL(
            'objectId',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectNewPresignedURLResponse::class, $result);
    }

    #[Test]
    public function testCreatePresignedURLWithOptionalParams(): void
    {
        $result = $this->client->vault->objects->createPresignedURL(
            'objectId',
            id: 'id',
            contentType: 'contentType',
            expiresIn: 60,
            operation: 'GET',
            sizeBytes: 1,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectNewPresignedURLResponse::class, $result);
    }

    #[Test]
    public function testDownload(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server doesn\'t support application/octet-stream responses');
        }

        $result = $this->client->vault->objects->download('objectId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsString($result);
    }

    #[Test]
    public function testDownloadWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server doesn\'t support application/octet-stream responses');
        }

        $result = $this->client->vault->objects->download('objectId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsString($result);
    }

    #[Test]
    public function testGetOcrWords(): void
    {
        $result = $this->client->vault->objects->getOcrWords('objectId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectGetOcrWordsResponse::class, $result);
    }

    #[Test]
    public function testGetOcrWordsWithOptionalParams(): void
    {
        $result = $this->client->vault->objects->getOcrWords(
            'objectId',
            id: 'id',
            page: 0,
            wordEnd: 0,
            wordStart: 0
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectGetOcrWordsResponse::class, $result);
    }

    #[Test]
    public function testGetSummarizeJob(): void
    {
        $result = $this->client->vault->objects->getSummarizeJob(
            'jobId',
            id: 'id',
            objectID: 'objectId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectGetSummarizeJobResponse::class, $result);
    }

    #[Test]
    public function testGetSummarizeJobWithOptionalParams(): void
    {
        $result = $this->client->vault->objects->getSummarizeJob(
            'jobId',
            id: 'id',
            objectID: 'objectId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectGetSummarizeJobResponse::class, $result);
    }

    #[Test]
    public function testGetText(): void
    {
        $result = $this->client->vault->objects->getText('objectId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectGetTextResponse::class, $result);
    }

    #[Test]
    public function testGetTextWithOptionalParams(): void
    {
        $result = $this->client->vault->objects->getText('objectId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectGetTextResponse::class, $result);
    }
}
