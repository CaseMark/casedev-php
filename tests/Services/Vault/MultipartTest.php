<?php

namespace Tests\Services\Vault;

use CaseDev\Client;
use CaseDev\Core\Util;
use CaseDev\Vault\Multipart\MultipartGetPartURLsResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class MultipartTest extends TestCase
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
    public function testAbort(): void
    {
        $result = $this->client->vault->multipart->abort(
            'id',
            objectID: 'objectId',
            uploadID: 'uploadId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testAbortWithOptionalParams(): void
    {
        $result = $this->client->vault->multipart->abort(
            'id',
            objectID: 'objectId',
            uploadID: 'uploadId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testGetPartURLs(): void
    {
        $result = $this->client->vault->multipart->getPartURLs(
            'id',
            objectID: 'objectId',
            parts: [['partNumber' => 1, 'sizeBytes' => 1]],
            uploadID: 'uploadId',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MultipartGetPartURLsResponse::class, $result);
    }

    #[Test]
    public function testGetPartURLsWithOptionalParams(): void
    {
        $result = $this->client->vault->multipart->getPartURLs(
            'id',
            objectID: 'objectId',
            parts: [['partNumber' => 1, 'sizeBytes' => 1]],
            uploadID: 'uploadId',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MultipartGetPartURLsResponse::class, $result);
    }
}
