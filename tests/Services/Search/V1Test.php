<?php

namespace Tests\Services\Search;

use Casedev\Client;
use Casedev\Core\Util;
use Casedev\Search\V1\V1AnswerResponse;
use Casedev\Search\V1\V1ContentsResponse;
use Casedev\Search\V1\V1GetResearchResponse;
use Casedev\Search\V1\V1ResearchResponse;
use Casedev\Search\V1\V1SearchResponse;
use Casedev\Search\V1\V1SimilarResponse;
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
    public function testAnswer(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->search->v1->answer(query: 'query');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1AnswerResponse::class, $result);
    }

    #[Test]
    public function testAnswerWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->search->v1->answer(
            query: 'query',
            excludeDomains: ['string'],
            includeDomains: ['string'],
            maxTokens: 0,
            model: 'model',
            numResults: 1,
            searchType: 'auto',
            stream: true,
            temperature: 0,
            text: true,
            useCustomLlm: true,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1AnswerResponse::class, $result);
    }

    #[Test]
    public function testContents(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->search->v1->contents(
            urls: ['https://example.com']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1ContentsResponse::class, $result);
    }

    #[Test]
    public function testContentsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->search->v1->contents(
            urls: ['https://example.com'],
            context: 'context',
            extras: (object) [],
            highlights: true,
            livecrawl: true,
            livecrawlTimeout: 0,
            subpages: true,
            subpageTarget: 0,
            summary: true,
            text: true,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1ContentsResponse::class, $result);
    }

    #[Test]
    public function testResearch(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->search->v1->research(instructions: 'instructions');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1ResearchResponse::class, $result);
    }

    #[Test]
    public function testResearchWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->search->v1->research(
            instructions: 'instructions',
            model: 'fast',
            outputSchema: (object) [],
            query: 'query',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1ResearchResponse::class, $result);
    }

    #[Test]
    public function testRetrieveResearch(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->search->v1->retrieveResearch('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1GetResearchResponse::class, $result);
    }

    #[Test]
    public function testSearch(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->search->v1->search(query: 'query');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1SearchResponse::class, $result);
    }

    #[Test]
    public function testSearchWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->search->v1->search(
            query: 'query',
            additionalQueries: ['string'],
            category: 'category',
            contents: 'contents',
            endCrawlDate: '2019-12-27',
            endPublishedDate: '2019-12-27',
            excludeDomains: ['string'],
            includeDomains: ['string'],
            includeText: true,
            numResults: 1,
            startCrawlDate: '2019-12-27',
            startPublishedDate: '2019-12-27',
            type: 'auto',
            userLocation: 'userLocation',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1SearchResponse::class, $result);
    }

    #[Test]
    public function testSimilar(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->search->v1->similar(url: 'https://example.com');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1SimilarResponse::class, $result);
    }

    #[Test]
    public function testSimilarWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->search->v1->similar(
            url: 'https://example.com',
            contents: 'contents',
            endCrawlDate: '2019-12-27',
            endPublishedDate: '2019-12-27',
            excludeDomains: ['string'],
            includeDomains: ['string'],
            includeText: true,
            numResults: 1,
            startCrawlDate: '2019-12-27',
            startPublishedDate: '2019-12-27',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(V1SimilarResponse::class, $result);
    }
}
