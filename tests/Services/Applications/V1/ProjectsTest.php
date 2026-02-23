<?php

namespace Tests\Services\Applications\V1;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Router\Applications\V1\Projects\ProjectListResponse;
use Router\Client;
use Router\Core\Util;

/**
 * @internal
 */
#[CoversNothing]
final class ProjectsTest extends TestCase
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
        $result = $this->client->applications->v1->projects->create(
            gitRepo: 'gitRepo',
            name: 'name'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->applications->v1->projects->create(
            gitRepo: 'gitRepo',
            name: 'name',
            buildCommand: 'buildCommand',
            environmentVariables: [
                [
                    'key' => 'key',
                    'target' => ['production'],
                    'value' => 'value',
                    'type' => 'plain',
                ],
            ],
            framework: 'framework',
            gitBranch: 'gitBranch',
            installCommand: 'installCommand',
            outputDirectory: 'outputDirectory',
            rootDirectory: 'rootDirectory',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->applications->v1->projects->retrieve('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->applications->v1->projects->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProjectListResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->applications->v1->projects->delete('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCreateDeployment(): void
    {
        $result = $this->client->applications->v1->projects->createDeployment('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCreateDomain(): void
    {
        $result = $this->client->applications->v1->projects->createDomain(
            'id',
            domain: 'domain'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCreateDomainWithOptionalParams(): void
    {
        $result = $this->client->applications->v1->projects->createDomain(
            'id',
            domain: 'domain',
            gitBranch: 'gitBranch'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCreateEnv(): void
    {
        $result = $this->client->applications->v1->projects->createEnv(
            'id',
            key: 'key',
            target: ['production'],
            value: 'value'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCreateEnvWithOptionalParams(): void
    {
        $result = $this->client->applications->v1->projects->createEnv(
            'id',
            key: 'key',
            target: ['production'],
            value: 'value',
            gitBranch: 'gitBranch',
            type: 'plain',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testDeleteDomain(): void
    {
        $result = $this->client->applications->v1->projects->deleteDomain(
            'domain',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testDeleteDomainWithOptionalParams(): void
    {
        $result = $this->client->applications->v1->projects->deleteDomain(
            'domain',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testDeleteEnv(): void
    {
        $result = $this->client->applications->v1->projects->deleteEnv(
            'envId',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testDeleteEnvWithOptionalParams(): void
    {
        $result = $this->client->applications->v1->projects->deleteEnv(
            'envId',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testGetRuntimeLogs(): void
    {
        $result = $this->client->applications->v1->projects->getRuntimeLogs('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testListDeployments(): void
    {
        $result = $this->client->applications->v1->projects->listDeployments('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testListDomains(): void
    {
        $result = $this->client->applications->v1->projects->listDomains('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testListEnv(): void
    {
        $result = $this->client->applications->v1->projects->listEnv('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
