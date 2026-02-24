<?php

namespace Tests\Services\Translate;

use CaseDev\Client;
use CaseDev\Core\Util;
use CaseDev\Translate\V1\V1DetectResponse;
use CaseDev\Translate\V1\V1ListLanguagesResponse;
use CaseDev\Translate\V1\V1TranslateResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

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
        $result = $this->client->translate->v1->detect(q: 'string');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1DetectResponse::class, $result);
    }

    #[Test]
    public function testDetectWithOptionalParams(): void
    {
        $result = $this->client->translate->v1->detect(q: 'string');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1DetectResponse::class, $result);
    }

    #[Test]
    public function testListLanguages(): void
    {
        $result = $this->client->translate->v1->listLanguages();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1ListLanguagesResponse::class, $result);
    }

    #[Test]
    public function testTranslate(): void
    {
        $result = $this->client->translate->v1->translate(
            q: 'string',
            target: 'es'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1TranslateResponse::class, $result);
    }

    #[Test]
    public function testTranslateWithOptionalParams(): void
    {
        $result = $this->client->translate->v1->translate(
            q: 'string',
            target: 'es',
            format: 'text',
            model: 'nmt',
            source: 'en'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1TranslateResponse::class, $result);
    }
}
