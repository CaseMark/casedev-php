<?php

namespace Tests\Services\Matters\V1;

use CaseDev\Client;
use CaseDev\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class WorkItemsTest extends TestCase
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
        $result = $this->client->matters->v1->workItems->create(
            'id',
            title: 'title'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->matters->v1->workItems->create(
            'id',
            title: 'title',
            assigneeID: 'assignee_id',
            description: 'description',
            dueAt: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            exitCriteria: ['string'],
            instructions: 'instructions',
            metadata: ['foo' => 'bar'],
            priority: 'low',
            type: 'task',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->matters->v1->workItems->retrieve(
            'workItemId',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        $result = $this->client->matters->v1->workItems->retrieve(
            'workItemId',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->matters->v1->workItems->update(
            'workItemId',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        $result = $this->client->matters->v1->workItems->update(
            'workItemId',
            id: 'id',
            assigneeID: 'assignee_id',
            completedAt: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            description: 'description',
            dueAt: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            exitCriteria: ['string'],
            instructions: 'instructions',
            metadata: ['foo' => 'bar'],
            priority: 'low',
            startedAt: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            status: 'draft',
            title: 'title',
            type: 'task',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->matters->v1->workItems->list('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testDecide(): void
    {
        $result = $this->client->matters->v1->workItems->decide(
            'workItemId',
            id: 'id',
            decision: 'approve'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testDecideWithOptionalParams(): void
    {
        $result = $this->client->matters->v1->workItems->decide(
            'workItemId',
            id: 'id',
            decision: 'approve',
            agentTypeID: 'agent_type_id',
            metadata: ['foo' => 'bar'],
            reason: 'reason',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testListExecutions(): void
    {
        $result = $this->client->matters->v1->workItems->listExecutions(
            'workItemId',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testListExecutionsWithOptionalParams(): void
    {
        $result = $this->client->matters->v1->workItems->listExecutions(
            'workItemId',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
