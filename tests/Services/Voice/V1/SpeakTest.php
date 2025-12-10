<?php

namespace Tests\Services\Voice\V1;

use Casedev\Client;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class SpeakTest extends TestCase
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
            $this->markTestSkipped('Prism doesn\'t support audio/mpeg responses');
        }

        $result = $this->client->voice->v1->speak->create(text: 'text');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsString($result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism doesn\'t support audio/mpeg responses');
        }

        $result = $this->client->voice->v1->speak->create(
            text: 'text',
            applyTextNormalization: true,
            enableLogging: true,
            languageCode: 'en',
            modelID: 'eleven_multilingual_v2',
            nextText: 'next_text',
            optimizeStreamingLatency: 0,
            outputFormat: 'mp3_44100_128',
            previousText: 'previous_text',
            seed: 0,
            voiceID: 'voice_id',
            voiceSettings: [
                'similarityBoost' => 0,
                'stability' => 0,
                'style' => 0,
                'useSpeakerBoost' => true,
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsString($result);
    }

    #[Test]
    public function testStream(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism doesn\'t support audio/mpeg responses');
        }

        $result = $this->client->voice->v1->speak->stream(text: 'text');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsString($result);
    }

    #[Test]
    public function testStreamWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism doesn\'t support audio/mpeg responses');
        }

        $result = $this->client->voice->v1->speak->stream(
            text: 'text',
            applyTextNormalization: true,
            enableLogging: true,
            languageCode: 'language_code',
            modelID: 'eleven_monolingual_v1',
            nextText: 'next_text',
            optimizeStreamingLatency: 0,
            outputFormat: 'mp3_44100_128',
            previousText: 'previous_text',
            seed: 0,
            voiceID: 'voice_id',
            voiceSettings: [
                'similarityBoost' => 0,
                'stability' => 0,
                'style' => 0,
                'useSpeakerBoost' => true,
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsString($result);
    }
}
