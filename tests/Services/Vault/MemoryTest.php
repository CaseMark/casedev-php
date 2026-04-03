<?php

namespace Tests\Services\Vault;

use CaseDev\Client;
use CaseDev\Core\Util;
use CaseDev\Vault\Memory\MemoryListResponse;
use CaseDev\Vault\Memory\MemoryNewResponse;
use CaseDev\Vault\Memory\MemorySearchResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class MemoryTest extends TestCase
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
    public function testCreate(): void
    {
        $result = $this->client->vault->memory->create(
            'id',
            content: 'content',
            type: 'fact'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MemoryNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->vault->memory->create(
            'id',
            content: 'content',
            type: 'fact',
            source: 'source',
            tags: ['string']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MemoryNewResponse::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->vault->memory->update('entryId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        $result = $this->client->vault->memory->update(
            'entryId',
            id: 'id',
            content: 'content',
            source: 'source',
            tags: ['string'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->vault->memory->list('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MemoryListResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->vault->memory->delete('entryId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        $result = $this->client->vault->memory->delete('entryId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testSearch(): void
    {
        $result = $this->client->vault->memory->search('id', query: 'query');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MemorySearchResponse::class, $result);
    }

    #[Test]
    public function testSearchWithOptionalParams(): void
    {
        $result = $this->client->vault->memory->search(
            'id',
            query: 'query',
            limit: 1,
            tags: ['string'],
            types: ['string']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MemorySearchResponse::class, $result);
    }
}
