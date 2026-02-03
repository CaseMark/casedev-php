<?php

namespace Tests\Services\Memory;

use Casedev\Client;
use Casedev\Core\Util;
use Casedev\Memory\V1\V1DeleteAllResponse;
use Casedev\Memory\V1\V1DeleteResponse;
use Casedev\Memory\V1\V1GetResponse;
use Casedev\Memory\V1\V1ListResponse;
use Casedev\Memory\V1\V1NewResponse;
use Casedev\Memory\V1\V1SearchResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
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
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->memory->v1->create(
            messages: [['content' => 'content', 'role' => 'user']]
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1NewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->memory->v1->create(
            messages: [['content' => 'content', 'role' => 'user']],
            category: 'category',
            extractionPrompt: 'extraction_prompt',
            infer: true,
            metadata: ['foo' => 'bar'],
            tag1: 'tag_1',
            tag10: 'tag_10',
            tag11: 'tag_11',
            tag12: 'tag_12',
            tag2: 'tag_2',
            tag3: 'tag_3',
            tag4: 'tag_4',
            tag5: 'tag_5',
            tag6: 'tag_6',
            tag7: 'tag_7',
            tag8: 'tag_8',
            tag9: 'tag_9',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1NewResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->memory->v1->retrieve('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1GetResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->memory->v1->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1ListResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->memory->v1->delete('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1DeleteResponse::class, $result);
    }

    #[Test]
    public function testDeleteAll(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->memory->v1->deleteAll();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1DeleteAllResponse::class, $result);
    }

    #[Test]
    public function testSearch(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->memory->v1->search(query: 'query');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1SearchResponse::class, $result);
    }

    #[Test]
    public function testSearchWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->memory->v1->search(
            query: 'query',
            category: 'category',
            tag1: 'tag_1',
            tag10: 'tag_10',
            tag11: 'tag_11',
            tag12: 'tag_12',
            tag2: 'tag_2',
            tag3: 'tag_3',
            tag4: 'tag_4',
            tag5: 'tag_5',
            tag6: 'tag_6',
            tag7: 'tag_7',
            tag8: 'tag_8',
            tag9: 'tag_9',
            topK: 1,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1SearchResponse::class, $result);
    }
}
