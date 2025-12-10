<?php

namespace Tests\Services\Compute;

use Casedev\Client;
use Casedev\Compute\V1\V1DeployResponse;
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
    public function testDeploy(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->compute->v1->deploy(
            entrypointName: 'entrypointName',
            type: 'task'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1DeployResponse::class, $result);
    }

    #[Test]
    public function testDeployWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->compute->v1->deploy(
            entrypointName: 'entrypointName',
            type: 'task',
            code: 'code',
            config: [
                'addPython' => 'addPython',
                'allowNetwork' => true,
                'cmd' => ['string'],
                'concurrency' => 0,
                'cpuCount' => 0,
                'cronSchedule' => 'cronSchedule',
                'dependencies' => ['string'],
                'entrypoint' => ['string'],
                'env' => ['foo' => 'string'],
                'gpuCount' => 0,
                'gpuType' => 'cpu',
                'isWebService' => true,
                'memoryMB' => 0,
                'pipInstall' => ['string'],
                'port' => 0,
                'pythonVersion' => 'pythonVersion',
                'retries' => 0,
                'secretGroups' => ['string'],
                'timeoutSeconds' => 0,
                'useUv' => true,
                'warmInstances' => 0,
                'workdir' => 'workdir',
            ],
            dockerfile: 'dockerfile',
            entrypointFile: 'entrypointFile',
            environment: 'environment',
            image: 'image',
            runtime: 'python',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1DeployResponse::class, $result);
    }

    #[Test]
    public function testGetPricing(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->compute->v1->getPricing();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testGetUsage(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->compute->v1->getUsage();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
