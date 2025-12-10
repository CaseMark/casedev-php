<?php

namespace Tests\Services\Workflows;

use Casedev\Client;
use Casedev\Workflows\V1\V1DeleteResponse;
use Casedev\Workflows\V1\V1DeployResponse;
use Casedev\Workflows\V1\V1ExecuteResponse;
use Casedev\Workflows\V1\V1GetExecutionResponse;
use Casedev\Workflows\V1\V1GetResponse;
use Casedev\Workflows\V1\V1ListExecutionsResponse;
use Casedev\Workflows\V1\V1ListResponse;
use Casedev\Workflows\V1\V1NewResponse;
use Casedev\Workflows\V1\V1UndeployResponse;
use Casedev\Workflows\V1\V1UpdateResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

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

        $result = $this->client->workflows->v1->create(name: 'Document Processor');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1NewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->workflows->v1->create(
            name: 'Document Processor',
            description: 'description',
            edges: [[]],
            nodes: [[]],
            triggerConfig: [],
            triggerType: 'manual',
            visibility: 'private',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1NewResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->workflows->v1->retrieve('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1GetResponse::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->workflows->v1->update('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1UpdateResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->workflows->v1->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1ListResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->workflows->v1->delete('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1DeleteResponse::class, $result);
    }

    #[Test]
    public function testDeploy(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->workflows->v1->deploy('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1DeployResponse::class, $result);
    }

    #[Test]
    public function testExecute(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->workflows->v1->execute('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1ExecuteResponse::class, $result);
    }

    #[Test]
    public function testListExecutions(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->workflows->v1->listExecutions('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1ListExecutionsResponse::class, $result);
    }

    #[Test]
    public function testRetrieveExecution(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->workflows->v1->retrieveExecution('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1GetExecutionResponse::class, $result);
    }

    #[Test]
    public function testUndeploy(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->workflows->v1->undeploy('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1UndeployResponse::class, $result);
    }
}
