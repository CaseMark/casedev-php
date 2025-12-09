<?php

namespace Tests\Services\Voice;

use Casedev\Client;
use Casedev\Voice\Transcription\TranscriptionGetResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

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

        $testUrl = getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->voice->transcription->create([
            'audioURL' => 'audio_url',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->voice->transcription->create([
            'audioURL' => 'audio_url',
            'autoHighlights' => true,
            'contentSafetyLabels' => true,
            'formatText' => true,
            'languageCode' => 'language_code',
            'languageDetection' => true,
            'punctuate' => true,
            'speakerLabels' => true,
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->voice->transcription->retrieve(
            '5551902f-fc65-4a61-81b2-e002d4e464e5'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(TranscriptionGetResponse::class, $result);
    }
}
