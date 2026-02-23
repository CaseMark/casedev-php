<?php

namespace Tests\Services\Llm;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Router\Client;
use Router\Core\Util;
use Router\Llm\V1\V1ListModelsResponse;
use Router\Llm\V1\V1NewEmbeddingResponse;

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
    public function testCreateEmbedding(): void
    {
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
        $result = $this->client->llm->v1->listModels();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1ListModelsResponse::class, $result);
    }
}
