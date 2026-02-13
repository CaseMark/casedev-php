<?php

namespace Tests\Services\Legal;

use Casedev\Client;
use Casedev\Core\Util;
use Casedev\Legal\V1\V1FindResponse;
use Casedev\Legal\V1\V1GetCitationsFromURLResponse;
use Casedev\Legal\V1\V1GetCitationsResponse;
use Casedev\Legal\V1\V1GetFullTextResponse;
use Casedev\Legal\V1\V1ListJurisdictionsResponse;
use Casedev\Legal\V1\V1PatentSearchResponse;
use Casedev\Legal\V1\V1ResearchResponse;
use Casedev\Legal\V1\V1SimilarResponse;
use Casedev\Legal\V1\V1VerifyResponse;
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

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testFind(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->legal->v1->find(query: 'xxx');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1FindResponse::class, $result);
    }

    #[Test]
    public function testFindWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->legal->v1->find(
            query: 'xxx',
            jurisdiction: 'jurisdiction',
            numResults: 1
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1FindResponse::class, $result);
    }

    #[Test]
    public function testGetCitations(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->legal->v1->getCitations(text: 'text');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1GetCitationsResponse::class, $result);
    }

    #[Test]
    public function testGetCitationsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->legal->v1->getCitations(text: 'text');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1GetCitationsResponse::class, $result);
    }

    #[Test]
    public function testGetCitationsFromURL(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->legal->v1->getCitationsFromURL(
            url: 'https://example.com'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1GetCitationsFromURLResponse::class, $result);
    }

    #[Test]
    public function testGetCitationsFromURLWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->legal->v1->getCitationsFromURL(
            url: 'https://example.com'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1GetCitationsFromURLResponse::class, $result);
    }

    #[Test]
    public function testGetFullText(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->legal->v1->getFullText(url: 'https://example.com');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1GetFullTextResponse::class, $result);
    }

    #[Test]
    public function testGetFullTextWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->legal->v1->getFullText(
            url: 'https://example.com',
            highlightQuery: 'highlightQuery',
            maxCharacters: 1000,
            summaryQuery: 'summaryQuery',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1GetFullTextResponse::class, $result);
    }

    #[Test]
    public function testListJurisdictions(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->legal->v1->listJurisdictions(name: 'xx');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1ListJurisdictionsResponse::class, $result);
    }

    #[Test]
    public function testListJurisdictionsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->legal->v1->listJurisdictions(name: 'xx');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1ListJurisdictionsResponse::class, $result);
    }

    #[Test]
    public function testPatentSearch(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->legal->v1->patentSearch(query: 'x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1PatentSearchResponse::class, $result);
    }

    #[Test]
    public function testPatentSearchWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->legal->v1->patentSearch(
            query: 'x',
            applicationStatus: 'applicationStatus',
            applicationType: 'Utility',
            assignee: 'assignee',
            filingDateFrom: '2019-12-27',
            filingDateTo: '2019-12-27',
            grantDateFrom: '2019-12-27',
            grantDateTo: '2019-12-27',
            inventor: 'inventor',
            limit: 1,
            offset: 0,
            sortBy: 'filingDate',
            sortOrder: 'asc',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1PatentSearchResponse::class, $result);
    }

    #[Test]
    public function testResearch(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->legal->v1->research(query: 'xxx');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1ResearchResponse::class, $result);
    }

    #[Test]
    public function testResearchWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->legal->v1->research(
            query: 'xxx',
            additionalQueries: ['string'],
            jurisdiction: 'jurisdiction',
            numResults: 1,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1ResearchResponse::class, $result);
    }

    #[Test]
    public function testSimilar(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->legal->v1->similar(url: 'https://example.com');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1SimilarResponse::class, $result);
    }

    #[Test]
    public function testSimilarWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->legal->v1->similar(
            url: 'https://example.com',
            jurisdiction: 'jurisdiction',
            numResults: 1,
            startPublishedDate: '2019-12-27',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1SimilarResponse::class, $result);
    }

    #[Test]
    public function testVerify(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->legal->v1->verify(text: 'text');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1VerifyResponse::class, $result);
    }

    #[Test]
    public function testVerifyWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->legal->v1->verify(text: 'text');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1VerifyResponse::class, $result);
    }
}
