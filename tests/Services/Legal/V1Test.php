<?php

namespace Tests\Services\Legal;

use CaseDev\Client;
use CaseDev\Core\Util;
use CaseDev\Legal\V1\V1FindResponse;
use CaseDev\Legal\V1\V1GetCitationsFromURLResponse;
use CaseDev\Legal\V1\V1GetCitationsResponse;
use CaseDev\Legal\V1\V1GetFullTextResponse;
use CaseDev\Legal\V1\V1ListJurisdictionsResponse;
use CaseDev\Legal\V1\V1PatentSearchResponse;
use CaseDev\Legal\V1\V1ResearchResponse;
use CaseDev\Legal\V1\V1SimilarResponse;
use CaseDev\Legal\V1\V1TrademarkSearchResponse;
use CaseDev\Legal\V1\V1VerifyResponse;
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
    public function testFind(): void
    {
        $result = $this->client->legal->v1->find(query: 'xxx');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1FindResponse::class, $result);
    }

    #[Test]
    public function testFindWithOptionalParams(): void
    {
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
        $result = $this->client->legal->v1->getCitations(text: 'text');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1GetCitationsResponse::class, $result);
    }

    #[Test]
    public function testGetCitationsWithOptionalParams(): void
    {
        $result = $this->client->legal->v1->getCitations(text: 'text');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1GetCitationsResponse::class, $result);
    }

    #[Test]
    public function testGetCitationsFromURL(): void
    {
        $result = $this->client->legal->v1->getCitationsFromURL(
            url: 'https://example.com'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1GetCitationsFromURLResponse::class, $result);
    }

    #[Test]
    public function testGetCitationsFromURLWithOptionalParams(): void
    {
        $result = $this->client->legal->v1->getCitationsFromURL(
            url: 'https://example.com'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1GetCitationsFromURLResponse::class, $result);
    }

    #[Test]
    public function testGetFullText(): void
    {
        $result = $this->client->legal->v1->getFullText(url: 'https://example.com');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1GetFullTextResponse::class, $result);
    }

    #[Test]
    public function testGetFullTextWithOptionalParams(): void
    {
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
        $result = $this->client->legal->v1->listJurisdictions(name: 'xx');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1ListJurisdictionsResponse::class, $result);
    }

    #[Test]
    public function testListJurisdictionsWithOptionalParams(): void
    {
        $result = $this->client->legal->v1->listJurisdictions(name: 'xx');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1ListJurisdictionsResponse::class, $result);
    }

    #[Test]
    public function testPatentSearch(): void
    {
        $result = $this->client->legal->v1->patentSearch(query: 'x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1PatentSearchResponse::class, $result);
    }

    #[Test]
    public function testPatentSearchWithOptionalParams(): void
    {
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
        $result = $this->client->legal->v1->research(query: 'xxx');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1ResearchResponse::class, $result);
    }

    #[Test]
    public function testResearchWithOptionalParams(): void
    {
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
        $result = $this->client->legal->v1->similar(url: 'https://example.com');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1SimilarResponse::class, $result);
    }

    #[Test]
    public function testSimilarWithOptionalParams(): void
    {
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
    public function testTrademarkSearch(): void
    {
        $result = $this->client->legal->v1->trademarkSearch();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1TrademarkSearchResponse::class, $result);
    }

    #[Test]
    public function testVerify(): void
    {
        $result = $this->client->legal->v1->verify(text: 'text');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1VerifyResponse::class, $result);
    }

    #[Test]
    public function testVerifyWithOptionalParams(): void
    {
        $result = $this->client->legal->v1->verify(text: 'text');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1VerifyResponse::class, $result);
    }
}
