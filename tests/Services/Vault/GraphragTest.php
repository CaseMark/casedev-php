<?php

namespace Tests\Services\Vault;

use Casedev\Client;
use Casedev\Core\Util;
use Casedev\Vault\Graphrag\GraphragGetStatsResponse;
use Casedev\Vault\Graphrag\GraphragInitResponse;
use Casedev\Vault\Graphrag\GraphragProcessObjectResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class GraphragTest extends TestCase
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
    public function testGetStats(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->graphrag->getStats('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(GraphragGetStatsResponse::class, $result);
    }

    #[Test]
    public function testInit(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->graphrag->init('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(GraphragInitResponse::class, $result);
    }

    #[Test]
    public function testProcessObject(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->graphrag->processObject(
            'objectId',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(GraphragProcessObjectResponse::class, $result);
    }

    #[Test]
    public function testProcessObjectWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->vault->graphrag->processObject(
            'objectId',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(GraphragProcessObjectResponse::class, $result);
    }
}
