<?php

namespace Tests\Services\Llm;

use Casedev\Client;
use Casedev\Llm\V1\V1ListModelsResponse;
use Casedev\Llm\V1\V1NewEmbeddingResponse;
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

        $testUrl = getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testCreateEmbedding(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->llm->v1->createEmbedding(
            input: 'string',
            model: 'model'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1NewEmbeddingResponse::class, $result);
    }

    #[Test]
    public function testCreateEmbeddingWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->llm->v1->createEmbedding(
            input: 'string',
            model: 'model',
            dimensions: 0,
            encodingFormat: 'float',
            user: 'user',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1NewEmbeddingResponse::class, $result);
    }

    #[Test]
    public function testListModels(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->llm->v1->listModels();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1ListModelsResponse::class, $result);
    }
}
