<?php

namespace Tests\Services\Compute\V1;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Router\Client;
use Router\Compute\V1\Secrets\SecretDeleteGroupResponse;
use Router\Compute\V1\Secrets\SecretGetGroupResponse;
use Router\Compute\V1\Secrets\SecretListResponse;
use Router\Compute\V1\Secrets\SecretNewResponse;
use Router\Compute\V1\Secrets\SecretUpdateGroupResponse;
use Router\Core\Util;

/**
 * @internal
 */
#[CoversNothing]
final class SecretsTest extends TestCase
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
        $result = $this->client->compute->v1->secrets->create(name: 'name');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SecretNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->compute->v1->secrets->create(
            name: 'name',
            description: 'description',
            env: 'env'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SecretNewResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->compute->v1->secrets->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SecretListResponse::class, $result);
    }

    #[Test]
    public function testDeleteGroup(): void
    {
        $result = $this->client->compute->v1->secrets->deleteGroup('group');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SecretDeleteGroupResponse::class, $result);
    }

    #[Test]
    public function testRetrieveGroup(): void
    {
        $result = $this->client->compute->v1->secrets->retrieveGroup('group');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SecretGetGroupResponse::class, $result);
    }

    #[Test]
    public function testUpdateGroup(): void
    {
        $result = $this->client->compute->v1->secrets->updateGroup(
            'litigation-apis',
            secrets: ['foo' => 'string']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SecretUpdateGroupResponse::class, $result);
    }

    #[Test]
    public function testUpdateGroupWithOptionalParams(): void
    {
        $result = $this->client->compute->v1->secrets->updateGroup(
            'litigation-apis',
            secrets: ['foo' => 'string'],
            env: 'env'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SecretUpdateGroupResponse::class, $result);
    }
}
