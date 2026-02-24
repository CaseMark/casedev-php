<?php

namespace Tests\Services\Voice;

use CaseDev\Client;
use CaseDev\Core\Util;
use CaseDev\Voice\Streaming\StreamingGetURLResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class StreamingTest extends TestCase
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
    public function testGetURL(): void
    {
        $result = $this->client->voice->streaming->getURL();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(StreamingGetURLResponse::class, $result);
    }
}
