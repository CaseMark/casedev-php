<?php

namespace Tests\Services\Voice;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Router\Client;
use Router\Core\Util;
use Router\Voice\Transcription\TranscriptionGetResponse;
use Router\Voice\Transcription\TranscriptionNewResponse;

/**
 * @internal
 */
#[CoversNothing]
final class TranscriptionTest extends TestCase
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
        $result = $this->client->voice->transcription->create();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(TranscriptionNewResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->voice->transcription->retrieve('tr_abc123def456');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(TranscriptionGetResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->voice->transcription->delete('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
