<?php

namespace Tests\Services\Vault;

use Casedev\Client;
use Casedev\Core\Util;
use Casedev\Vault\Objects\ObjectDeleteResponse;
use Casedev\Vault\Objects\ObjectGetOcrWordsResponse;
use Casedev\Vault\Objects\ObjectGetResponse;
use Casedev\Vault\Objects\ObjectGetSummarizeJobResponse;
use Casedev\Vault\Objects\ObjectGetTextResponse;
use Casedev\Vault\Objects\ObjectListResponse;
use Casedev\Vault\Objects\ObjectNewPresignedURLResponse;
use Casedev\Vault\Objects\ObjectUpdateResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
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
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->objects->retrieve('objectId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectGetResponse::class, $result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->objects->retrieve('objectId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectGetResponse::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->objects->update('objectId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectUpdateResponse::class, $result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

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
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->objects->list('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectListResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->objects->delete('objectId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectDeleteResponse::class, $result);
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

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
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

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
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

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
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->objects->download('objectId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsString($result);
    }

    #[Test]
    public function testDownloadWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->objects->download('objectId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsString($result);
    }

    #[Test]
    public function testGetOcrWords(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->objects->getOcrWords('objectId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectGetOcrWordsResponse::class, $result);
    }

    #[Test]
    public function testGetOcrWordsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

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
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

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
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

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
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->objects->getText('objectId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectGetTextResponse::class, $result);
    }

    #[Test]
    public function testGetTextWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->objects->getText('objectId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ObjectGetTextResponse::class, $result);
    }
}
