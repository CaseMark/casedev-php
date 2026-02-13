<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Legal;

use Casedev\Core\Exceptions\APIException;
use Casedev\Legal\V1\V1FindResponse;
use Casedev\Legal\V1\V1GetCitationsFromURLResponse;
use Casedev\Legal\V1\V1GetCitationsResponse;
use Casedev\Legal\V1\V1GetFullTextResponse;
use Casedev\Legal\V1\V1ListJurisdictionsResponse;
use Casedev\Legal\V1\V1PatentSearchParams\ApplicationType;
use Casedev\Legal\V1\V1PatentSearchParams\SortBy;
use Casedev\Legal\V1\V1PatentSearchParams\SortOrder;
use Casedev\Legal\V1\V1PatentSearchResponse;
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
     * @param string $query Free-text search across all patent fields, or field-specific query (e.g. "applicationMetaData.patentNumber:11234567"). Supports AND, OR, NOT operators.
     * @param string $applicationStatus Filter by application status (e.g. "Patented Case", "Abandoned", "Pending")
     * @param ApplicationType|value-of<ApplicationType> $applicationType Filter by application type
     * @param string $assignee Filter by assignee/owner name (e.g. "Google LLC")
     * @param string $filingDateFrom Start of filing date range (YYYY-MM-DD)
     * @param string $filingDateTo End of filing date range (YYYY-MM-DD)
     * @param string $grantDateFrom Start of grant date range (YYYY-MM-DD)
     * @param string $grantDateTo End of grant date range (YYYY-MM-DD)
     * @param string $inventor Filter by inventor name
     * @param int $limit Number of results to return (default 25, max 100)
     * @param int $offset Starting position for pagination
     * @param SortBy|value-of<SortBy> $sortBy Field to sort results by
     * @param SortOrder|value-of<SortOrder> $sortOrder Sort order (default desc, newest first)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function patentSearch(
        string $query,
        ?string $applicationStatus = null,
        ApplicationType|string|null $applicationType = null,
        ?string $assignee = null,
        ?string $filingDateFrom = null,
        ?string $filingDateTo = null,
        ?string $grantDateFrom = null,
        ?string $grantDateTo = null,
        ?string $inventor = null,
        int $limit = 25,
        int $offset = 0,
        SortBy|string $sortBy = 'filingDate',
        SortOrder|string $sortOrder = 'desc',
        RequestOptions|array|null $requestOptions = null,
    ): V1PatentSearchResponse;

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
