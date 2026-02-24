<?php

namespace Tests\Services\Applications\V1;

use CaseDev\Client;
use CaseDev\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class DeploymentsTest extends TestCase
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
        $result = $this->client->applications->v1->deployments->create(
            projectID: 'projectId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->applications->v1->deployments->create(
            projectID: 'projectId',
            ref: 'ref',
            target: 'production'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->applications->v1->deployments->retrieve(
            'id',
            projectID: 'projectId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        $result = $this->client->applications->v1->deployments->retrieve(
            'id',
            projectID: 'projectId',
            includeLogs: true
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->applications->v1->deployments->list(
            projectID: 'projectId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testListWithOptionalParams(): void
    {
        $result = $this->client->applications->v1->deployments->list(
            projectID: 'projectId',
            limit: 0,
            state: 'state',
            target: 'production'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCancel(): void
    {
        $result = $this->client->applications->v1->deployments->cancel(
            'id',
            projectID: 'projectId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCancelWithOptionalParams(): void
    {
        $result = $this->client->applications->v1->deployments->cancel(
            'id',
            projectID: 'projectId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCreateFromFiles(): void
    {
        $result = $this->client->applications->v1->deployments->createFromFiles();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testGetLogs(): void
    {
        $result = $this->client->applications->v1->deployments->getLogs(
            'id',
            projectID: 'projectId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testGetLogsWithOptionalParams(): void
    {
        $result = $this->client->applications->v1->deployments->getLogs(
            'id',
            projectID: 'projectId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testGetStatus(): void
    {
        $result = $this->client->applications->v1->deployments->getStatus('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testStream(): void
    {
        $result = $this->client->applications->v1->deployments->stream(
            'id',
            projectID: 'projectId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testStreamWithOptionalParams(): void
    {
        $result = $this->client->applications->v1->deployments->stream(
            'id',
            projectID: 'projectId',
            startIndex: 0
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
