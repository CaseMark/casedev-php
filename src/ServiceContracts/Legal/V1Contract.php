<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Legal;

use Casedev\Core\Exceptions\APIException;
use Casedev\Legal\V1\V1FindResponse;
use Casedev\Legal\V1\V1GetCitationsFromURLResponse;
use Casedev\Legal\V1\V1GetCitationsResponse;
use Casedev\Legal\V1\V1GetFullTextResponse;
use Casedev\Legal\V1\V1ListJurisdictionsResponse;
use Casedev\Legal\V1\V1ResearchResponse;
use Casedev\Legal\V1\V1SimilarResponse;
use Casedev\Legal\V1\V1VerifyResponse;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface V1Contract
{
    /**
     * @api
     *
     * @param string $query Search query (e.g., "fair use copyright", "Miranda rights")
     * @param string $jurisdiction Optional jurisdiction ID from resolveJurisdiction (e.g., "california", "us-federal")
     * @param int $numResults Number of results 1-25 (default: 10)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function find(
        string $query,
        ?string $jurisdiction = null,
        int $numResults = 10,
        RequestOptions|array|null $requestOptions = null,
    ): V1FindResponse;

    /**
     * @api
     *
     * @param string $text Text containing citations to extract. Can be a single citation (e.g., "531 U.S. 98") or a full document with multiple citations.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getCitations(
        string $text,
        RequestOptions|array|null $requestOptions = null
    ): V1GetCitationsResponse;

    /**
     * @api
     *
     * @param string $url URL of the legal document to extract citations from
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getCitationsFromURL(
        string $url,
        RequestOptions|array|null $requestOptions = null
    ): V1GetCitationsFromURLResponse;

    /**
     * @api
     *
     * @param string $url URL of the verified legal document
     * @param string $highlightQuery Optional query to extract relevant highlights (e.g., "What is the holding?")
     * @param int $maxCharacters Maximum characters to return (default: 10000, max: 50000)
     * @param string $summaryQuery Optional query for generating a summary (e.g., "Summarize the key ruling")
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getFullText(
        string $url,
        ?string $highlightQuery = null,
        int $maxCharacters = 10000,
        ?string $summaryQuery = null,
        RequestOptions|array|null $requestOptions = null,
    ): V1GetFullTextResponse;

    /**
     * @api
     *
     * @param string $name Jurisdiction name (e.g., "California", "US Federal", "NY")
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listJurisdictions(
        string $name,
        RequestOptions|array|null $requestOptions = null
    ): V1ListJurisdictionsResponse;

    /**
     * @api
     *
     * @param string $query Primary search query
     * @param list<string> $additionalQueries Additional query variations to search (e.g., different phrasings of the legal issue)
     * @param string $jurisdiction Optional jurisdiction ID from resolveJurisdiction
     * @param int $numResults Number of results 1-25 (default: 10)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function research(
        string $query,
        ?array $additionalQueries = null,
        ?string $jurisdiction = null,
        int $numResults = 10,
        RequestOptions|array|null $requestOptions = null,
    ): V1ResearchResponse;

    /**
     * @api
     *
     * @param string $url URL of a legal document to find similar sources for
     * @param string $jurisdiction Optional jurisdiction ID to filter results
     * @param int $numResults Number of results 1-25 (default: 10)
     * @param string $startPublishedDate Optional ISO date to find only newer documents (e.g., "2020-01-01")
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function similar(
        string $url,
        ?string $jurisdiction = null,
        int $numResults = 10,
        ?string $startPublishedDate = null,
        RequestOptions|array|null $requestOptions = null,
    ): V1SimilarResponse;

    /**
     * @api
     *
     * @param string $text Text containing citations to verify. Can be a single citation (e.g., "531 U.S. 98") or a full document with multiple citations.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function verify(
        string $text,
        RequestOptions|array|null $requestOptions = null
    ): V1VerifyResponse;
}
