<?php

namespace Tests\Services;

use CaseDev\Client;
use CaseDev\Core\Util;
use CaseDev\System\SystemListServicesResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class SystemTest extends TestCase
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
    public function testListServices(): void
    {
        $result = $this->client->system->listServices();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SystemListServicesResponse::class, $result);
    }
}
