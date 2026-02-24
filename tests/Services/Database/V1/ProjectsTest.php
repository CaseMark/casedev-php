<?php

namespace Tests\Services\Database\V1;

use CaseDev\Client;
use CaseDev\Core\Util;
use CaseDev\Database\V1\Projects\ProjectDeleteResponse;
use CaseDev\Database\V1\Projects\ProjectGetConnectionResponse;
use CaseDev\Database\V1\Projects\ProjectGetResponse;
use CaseDev\Database\V1\Projects\ProjectListBranchesResponse;
use CaseDev\Database\V1\Projects\ProjectListResponse;
use CaseDev\Database\V1\Projects\ProjectNewBranchResponse;
use CaseDev\Database\V1\Projects\ProjectNewResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

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
        $result = $this->client->database->v1->projects->create(
            name: 'litigation-docs-db'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProjectNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->database->v1->projects->create(
            name: 'litigation-docs-db',
            description: 'Production database for litigation document management',
            region: 'aws-us-east-1',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProjectNewResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->database->v1->projects->retrieve('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProjectGetResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->database->v1->projects->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProjectListResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->database->v1->projects->delete('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProjectDeleteResponse::class, $result);
    }

    #[Test]
    public function testCreateBranch(): void
    {
        $result = $this->client->database->v1->projects->createBranch(
            'id',
            name: 'staging'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProjectNewBranchResponse::class, $result);
    }

    #[Test]
    public function testCreateBranchWithOptionalParams(): void
    {
        $result = $this->client->database->v1->projects->createBranch(
            'id',
            name: 'staging',
            parentBranchID: 'branch_main_123'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProjectNewBranchResponse::class, $result);
    }

    #[Test]
    public function testGetConnection(): void
    {
        $result = $this->client->database->v1->projects->getConnection('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProjectGetConnectionResponse::class, $result);
    }

    #[Test]
    public function testListBranches(): void
    {
        $result = $this->client->database->v1->projects->listBranches('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProjectListBranchesResponse::class, $result);
    }
}
