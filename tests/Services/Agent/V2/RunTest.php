<?php

namespace Tests\Services\Agent\V2;

use CaseDev\Agent\V2\Run\RunExecResponse;
use CaseDev\Agent\V2\Run\RunGetStatusResponse;
use CaseDev\Agent\V2\Run\RunNewResponse;
use CaseDev\Client;
use CaseDev\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class RunTest extends TestCase
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
        $result = $this->client->agent->v2->run->create(
            agentID: 'agentId',
            prompt: 'prompt'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RunNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->agent->v2->run->create(
            agentID: 'agentId',
            prompt: 'prompt',
            callbackURL: 'https://example.com',
            guidance: 'guidance',
            model: 'model',
            objectIDs: ['string'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RunNewResponse::class, $result);
    }

    #[Test]
    public function testExec(): void
    {
        $result = $this->client->agent->v2->run->exec('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RunExecResponse::class, $result);
    }

    #[Test]
    public function testGetDetails(): void
    {
        $result = $this->client->agent->v2->run->getDetails('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsNotResource($result);
    }

    #[Test]
    public function testGetStatus(): void
    {
        $result = $this->client->agent->v2->run->getStatus('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RunGetStatusResponse::class, $result);
    }
}
