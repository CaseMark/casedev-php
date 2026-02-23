<?php

namespace Tests\Services\Compute\V1;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Router\Client;
use Router\Compute\V1\Environments\EnvironmentDeleteResponse;
use Router\Compute\V1\Environments\EnvironmentGetResponse;
use Router\Compute\V1\Environments\EnvironmentListResponse;
use Router\Compute\V1\Environments\EnvironmentNewResponse;
use Router\Compute\V1\Environments\EnvironmentSetDefaultResponse;
use Router\Core\Util;

/**
 * @internal
 */
#[CoversNothing]
final class EnvironmentsTest extends TestCase
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
        $result = $this->client->compute->v1->environments->create(
            name: 'document-review-prod'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EnvironmentNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->compute->v1->environments->create(
            name: 'document-review-prod'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EnvironmentNewResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->compute->v1->environments->retrieve('name');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EnvironmentGetResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->compute->v1->environments->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EnvironmentListResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->compute->v1->environments->delete(
            'litigation-processing'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EnvironmentDeleteResponse::class, $result);
    }

    #[Test]
    public function testSetDefault(): void
    {
        $result = $this->client->compute->v1->environments->setDefault(
            'prod-legal-docs'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EnvironmentSetDefaultResponse::class, $result);
    }
}
