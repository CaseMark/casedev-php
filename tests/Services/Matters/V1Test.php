<?php

namespace Tests\Services\Matters;

use CaseDev\Client;
use CaseDev\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

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

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testCreate(): void
    {
        $result = $this->client->matters->v1->create(title: 'title');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->matters->v1->create(
            title: 'title',
            billing: ['foo' => 'bar'],
            clientName: 'client_name',
            clientPartyID: 'client_party_id',
            customFields: ['foo' => 'bar'],
            description: 'description',
            displayID: 'display_id',
            importantDates: ['foo' => 'bar'],
            jurisdiction: ['foo' => 'bar'],
            matterType: 'matter_type',
            metadata: ['foo' => 'bar'],
            practiceArea: 'practice_area',
            responsibleAttorneyID: 'responsible_attorney_id',
            status: 'intake',
            subtype: 'subtype',
            vault: [
                'description' => 'description',
                'enableGraph' => true,
                'enableIndexing' => true,
                'metadata' => ['foo' => 'bar'],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->matters->v1->retrieve('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->matters->v1->update('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->matters->v1->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
