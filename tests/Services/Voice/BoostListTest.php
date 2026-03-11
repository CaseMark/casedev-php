<?php

namespace Tests\Services\Voice;

use CaseDev\Client;
use CaseDev\Core\Util;
use CaseDev\Voice\BoostList\BoostListExtractResponse;
use CaseDev\Voice\BoostList\BoostListGenerateResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class BoostListTest extends TestCase
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
    public function testExtract(): void
    {
        $result = $this->client->voice->boostList->extract();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BoostListExtractResponse::class, $result);
    }

    #[Test]
    public function testGenerate(): void
    {
        $result = $this->client->voice->boostList->generate(
            transcriptionJobID: 'transcription_job_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BoostListGenerateResponse::class, $result);
    }

    #[Test]
    public function testGenerateWithOptionalParams(): void
    {
        $result = $this->client->voice->boostList->generate(
            transcriptionJobID: 'transcription_job_id',
            categories: ['person']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BoostListGenerateResponse::class, $result);
    }
}
