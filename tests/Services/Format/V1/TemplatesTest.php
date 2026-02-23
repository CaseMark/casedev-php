<?php

namespace Tests\Services\Format\V1;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Router\Client;
use Router\Core\Util;
use Router\Format\V1\Templates\TemplateGetResponse;
use Router\Format\V1\Templates\TemplateListResponse;
use Router\Format\V1\Templates\TemplateNewResponse;

/**
 * @internal
 */
#[CoversNothing]
final class TemplatesTest extends TestCase
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
        $result = $this->client->format->v1->templates->create(
            content: 'content',
            name: 'name',
            type: 'caption'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(TemplateNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->format->v1->templates->create(
            content: 'content',
            name: 'name',
            type: 'caption',
            description: 'description',
            styles: (object) [],
            tags: ['string'],
            variables: ['string'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(TemplateNewResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->format->v1->templates->retrieve('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(TemplateGetResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->format->v1->templates->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(TemplateListResponse::class, $result);
    }
}
