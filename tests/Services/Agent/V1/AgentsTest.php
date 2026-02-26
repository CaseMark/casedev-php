<?php

namespace Tests\Services\Agent\V1;

use CaseDev\Agent\V1\Agents\AgentDeleteResponse;
use CaseDev\Agent\V1\Agents\AgentGetResponse;
use CaseDev\Agent\V1\Agents\AgentListResponse;
use CaseDev\Agent\V1\Agents\AgentNewResponse;
use CaseDev\Agent\V1\Agents\AgentUpdateResponse;
use CaseDev\Client;
use CaseDev\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class AgentsTest extends TestCase
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
        $result = $this->client->agent->v1->agents->create(
            instructions: 'instructions',
            name: 'name'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AgentNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->agent->v1->agents->create(
            instructions: 'instructions',
            name: 'name',
            description: 'description',
            disabledTools: ['string'],
            enabledTools: ['string'],
            model: 'model',
            sandbox: ['cpu' => 0, 'memoryMiB' => 0],
            vaultGroups: ['string'],
            vaultIDs: ['string'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AgentNewResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->agent->v1->agents->retrieve('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AgentGetResponse::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->agent->v1->agents->update('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AgentUpdateResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->agent->v1->agents->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AgentListResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->agent->v1->agents->delete('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AgentDeleteResponse::class, $result);
    }
}
