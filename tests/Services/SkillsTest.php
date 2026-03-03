<?php

namespace Tests\Services;

use CaseDev\Client;
use CaseDev\Core\Util;
use CaseDev\Skills\SkillReadResponse;
use CaseDev\Skills\SkillResolveResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class SkillsTest extends TestCase
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
    public function testRead(): void
    {
        $result = $this->client->skills->read('slug');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SkillReadResponse::class, $result);
    }

    #[Test]
    public function testResolve(): void
    {
        $result = $this->client->skills->resolve(q: 'q');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SkillResolveResponse::class, $result);
    }

    #[Test]
    public function testResolveWithOptionalParams(): void
    {
        $result = $this->client->skills->resolve(q: 'q', limit: 1);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SkillResolveResponse::class, $result);
    }
}
