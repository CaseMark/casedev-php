<?php

namespace Tests\Services;

use CaseDev\Client;
use CaseDev\Core\Util;
use CaseDev\Llm\LlmGetConfigResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class LlmTest extends TestCase
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
    public function testGetConfig(): void
    {
        $result = $this->client->llm->getConfig();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LlmGetConfigResponse::class, $result);
    }
}
