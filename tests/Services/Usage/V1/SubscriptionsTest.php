<?php

namespace Tests\Services\Usage\V1;

use CaseDev\Client;
use CaseDev\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class SubscriptionsTest extends TestCase
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
        $result = $this->client->usage->v1->subscriptions->create(
            callbackURL: 'https://example.com'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->usage->v1->subscriptions->create(
            callbackURL: 'https://example.com',
            eventTypes: ['string'],
            signingSecret: 'signingSecret',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->usage->v1->subscriptions->update('subscriptionId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->usage->v1->subscriptions->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->usage->v1->subscriptions->delete('subscriptionId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testTest(): void
    {
        $result = $this->client->usage->v1->subscriptions->test('subscriptionId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
