<?php

namespace Tests\Services\Agent\V1;

use CaseDev\Agent\V1\Run\RunCancelResponse;
use CaseDev\Agent\V1\Run\RunExecResponse;
use CaseDev\Agent\V1\Run\RunGetDetailsResponse;
use CaseDev\Agent\V1\Run\RunGetStatusResponse;
use CaseDev\Agent\V1\Run\RunNewResponse;
use CaseDev\Agent\V1\Run\RunWatchResponse;
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
        $result = $this->client->agent->v1->run->create(
            agentID: 'agentId',
            prompt: 'prompt'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RunNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->agent->v1->run->create(
            agentID: 'agentId',
            prompt: 'prompt',
            guidance: 'guidance',
            model: 'model'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RunNewResponse::class, $result);
    }

    #[Test]
    public function testCancel(): void
    {
        $result = $this->client->agent->v1->run->cancel('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RunCancelResponse::class, $result);
    }

    #[Test]
    public function testExec(): void
    {
        $result = $this->client->agent->v1->run->exec('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RunExecResponse::class, $result);
    }

    #[Test]
    public function testGetDetails(): void
    {
        $result = $this->client->agent->v1->run->getDetails('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RunGetDetailsResponse::class, $result);
    }

    #[Test]
    public function testGetStatus(): void
    {
        $result = $this->client->agent->v1->run->getStatus('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RunGetStatusResponse::class, $result);
    }

    #[Test]
    public function testWatch(): void
    {
        $result = $this->client->agent->v1->run->watch(
            'id',
            callbackURL: 'https://example.com'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RunWatchResponse::class, $result);
    }

    #[Test]
    public function testWatchWithOptionalParams(): void
    {
        $result = $this->client->agent->v1->run->watch(
            'id',
            callbackURL: 'https://example.com'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RunWatchResponse::class, $result);
    }
}
