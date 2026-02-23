<?php

declare(strict_types=1);

namespace Router\Services\Search;

use Router\Client;
use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\RequestOptions;
use Router\Search\V1\V1AnswerParams;
use Router\Search\V1\V1AnswerParams\SearchType;
use Router\Search\V1\V1AnswerResponse;
use Router\Search\V1\V1ContentsParams;
use Router\Search\V1\V1ContentsResponse;
use Router\Search\V1\V1GetResearchResponse;
use Router\Search\V1\V1ResearchParams;
use Router\Search\V1\V1ResearchParams\Model;
use Router\Search\V1\V1ResearchResponse;
use Router\Search\V1\V1RetrieveResearchParams;
use Router\Search\V1\V1SearchParams;
use Router\Search\V1\V1SearchParams\Type;
use Router\Search\V1\V1SearchResponse;
use Router\Search\V1\V1SimilarParams;
use Router\Search\V1\V1SimilarResponse;
use Router\ServiceContracts\Search\V1RawContract;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
final class V1RawService implements V1RawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Generate comprehensive answers to questions using web search results. Supports two modes: native provider answers or custom LLM-powered answers using Case.dev's AI gateway. Perfect for legal research, fact-checking, and gathering supporting evidence for cases.
     *
     * @param array{
     *   query: string,
     *   excludeDomains?: list<string>,
     *   includeDomains?: list<string>,
     *   maxTokens?: int,
     *   model?: string,
     *   numResults?: int,
     *   searchType?: SearchType|value-of<SearchType>,
     *   stream?: bool,
     *   temperature?: float,
     *   text?: bool,
     *   useCustomLlm?: bool,
     * }|V1AnswerParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1AnswerResponse>
     *
     * @throws APIException
     */
    public function answer(
        array|V1AnswerParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1AnswerParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'search/v1/answer',
            body: (object) $parsed,
            options: $options,
            convert: V1AnswerResponse::class,
        );
    }

    /**
     * @api
     *
     * Scrapes and extracts text content from web pages, PDFs, and documents. Useful for legal research, evidence collection, and document analysis. Supports live crawling, subpage extraction, and content summarization.
     *
     * @param array{
     *   urls: list<string>,
     *   context?: string,
     *   extras?: mixed,
     *   highlights?: bool,
     *   livecrawl?: bool,
     *   livecrawlTimeout?: int,
     *   subpages?: bool,
     *   subpageTarget?: int,
     *   summary?: bool,
     *   text?: bool,
     * }|V1ContentsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1ContentsResponse>
     *
     * @throws APIException
     */
    public function contents(
        array|V1ContentsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1ContentsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'search/v1/contents',
            body: (object) $parsed,
            options: $options,
            convert: V1ContentsResponse::class,
        );
    }

    /**
     * @api
     *
     * Performs deep research by conducting multi-step analysis, gathering information from multiple sources, and providing comprehensive insights. Ideal for legal research, case analysis, and due diligence investigations.
     *
     * @param array{
     *   instructions: string,
     *   model?: Model|value-of<Model>,
     *   outputSchema?: mixed,
     *   query?: string,
     * }|V1ResearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1ResearchResponse>
     *
     * @throws APIException
     */
    public function research(
        array|V1ResearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1ResearchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'search/v1/research',
            body: (object) $parsed,
            options: $options,
            convert: V1ResearchResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve the status and results of a deep research task by ID. Supports both standard JSON responses and streaming for real-time updates as the research progresses. Research tasks analyze topics comprehensively using web search and AI synthesis.
     *
     * @param string $id Unique identifier for the research task
     * @param array{events?: string, stream?: bool}|V1RetrieveResearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1GetResearchResponse>
     *
     * @throws APIException
     */
    public function retrieveResearch(
        string $id,
        array|V1RetrieveResearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1RetrieveResearchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['search/v1/research/%1$s', $id],
            query: $parsed,
            options: $options,
            convert: V1GetResearchResponse::class,
        );
    }

    /**
     * @api
     *
     * Executes intelligent web search queries with advanced filtering and customization options. Ideal for legal research, case law discovery, and gathering supporting documentation for litigation or compliance matters.
     *
     * @param array{
     *   query: string,
     *   additionalQueries?: list<string>,
     *   category?: string,
     *   contents?: string,
     *   endCrawlDate?: string,
     *   endPublishedDate?: string,
     *   excludeDomains?: list<string>,
     *   includeDomains?: list<string>,
     *   includeText?: bool,
     *   numResults?: int,
     *   startCrawlDate?: string,
     *   startPublishedDate?: string,
     *   type?: Type|value-of<Type>,
     *   userLocation?: string,
     * }|V1SearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1SearchResponse>
     *
     * @throws APIException
     */
    public function search(
        array|V1SearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1SearchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'search/v1/search',
            body: (object) $parsed,
            options: $options,
            convert: V1SearchResponse::class,
        );
    }

    /**
     * @api
     *
     * Find web pages and documents similar to a given URL. Useful for legal research to discover related case law, statutes, or legal commentary that shares similar themes or content structure.
     *
     * @param array{
     *   url: string,
     *   contents?: string,
     *   endCrawlDate?: string,
     *   endPublishedDate?: string,
     *   excludeDomains?: list<string>,
     *   includeDomains?: list<string>,
     *   includeText?: bool,
     *   numResults?: int,
     *   startCrawlDate?: string,
     *   startPublishedDate?: string,
     * }|V1SimilarParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1SimilarResponse>
     *
     * @throws APIException
     */
    public function similar(
        array|V1SimilarParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1SimilarParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'search/v1/similar',
            body: (object) $parsed,
            options: $options,
            convert: V1SimilarResponse::class,
        );
    }
}
