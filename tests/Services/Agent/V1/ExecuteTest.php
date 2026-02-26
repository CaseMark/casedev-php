<?php

namespace Tests\Services\Agent\V1;

use CaseDev\Agent\V1\Execute\ExecuteNewResponse;
use CaseDev\Client;
use CaseDev\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class ExecuteTest extends TestCase
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
        $result = $this->client->agent->v1->execute->create(prompt: 'prompt');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ExecuteNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->agent->v1->execute->create(
            prompt: 'prompt',
            disabledTools: ['string'],
            enabledTools: ['string'],
            guidance: 'guidance',
            instructions: 'instructions',
            model: 'model',
            objectIDs: ['string'],
            sandbox: ['cpu' => 0, 'memoryMiB' => 0],
            vaultIDs: ['string'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ExecuteNewResponse::class, $result);
    }
}
