<?php

namespace Tests\Services\Privilege;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Router\Client;
use Router\Core\Util;
use Router\Privilege\V1\V1DetectResponse;

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
    public function testDetect(): void
    {
        $result = $this->client->privilege->v1->detect();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1DetectResponse::class, $result);
    }
}
