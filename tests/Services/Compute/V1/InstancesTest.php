<?php

namespace Tests\Services\Compute\V1;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Router\Client;
use Router\Compute\V1\Instances\InstanceDeleteResponse;
use Router\Compute\V1\Instances\InstanceGetResponse;
use Router\Compute\V1\Instances\InstanceListResponse;
use Router\Compute\V1\Instances\InstanceNewResponse;
use Router\Core\Util;

/**
 * @internal
 */
#[CoversNothing]
final class InstancesTest extends TestCase
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
        $result = $this->client->compute->v1->instances->create(
            instanceType: 'gpu_1x_a10',
            name: 'ocr-batch-job',
            region: 'us-west-1'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InstanceNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->compute->v1->instances->create(
            instanceType: 'gpu_1x_a10',
            name: 'ocr-batch-job',
            region: 'us-west-1',
            autoShutdownMinutes: 120,
            vaultIDs: ['vault_abc123'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InstanceNewResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->compute->v1->instances->retrieve('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InstanceGetResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->compute->v1->instances->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InstanceListResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->compute->v1->instances->delete('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InstanceDeleteResponse::class, $result);
    }
}
