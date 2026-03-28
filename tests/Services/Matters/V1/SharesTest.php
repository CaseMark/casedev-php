<?php

namespace Tests\Services\Matters\V1;

use CaseDev\Client;
use CaseDev\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class SharesTest extends TestCase
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
        $result = $this->client->matters->v1->shares->create(
            'id',
            targetOrgID: 'target_org_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->matters->v1->shares->create(
            'id',
            targetOrgID: 'target_org_id',
            expiresAt: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            permission: 'read',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->matters->v1->shares->list('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->matters->v1->shares->delete('shareId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        $result = $this->client->matters->v1->shares->delete('shareId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
