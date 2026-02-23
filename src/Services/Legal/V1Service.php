<?php

declare(strict_types=1);

namespace Router\Services\Legal;

use Router\Client;
use Router\Core\Exceptions\APIException;
use Router\Core\Util;
use Router\Legal\V1\V1FindResponse;
use Router\Legal\V1\V1GetCitationsFromURLResponse;
use Router\Legal\V1\V1GetCitationsResponse;
use Router\Legal\V1\V1GetFullTextResponse;
use Router\Legal\V1\V1ListJurisdictionsResponse;
use Router\Legal\V1\V1PatentSearchParams\ApplicationType;
use Router\Legal\V1\V1PatentSearchParams\SortBy;
use Router\Legal\V1\V1PatentSearchParams\SortOrder;
use Router\Legal\V1\V1PatentSearchResponse;
use Router\Legal\V1\V1ResearchResponse;
use Router\Legal\V1\V1SimilarResponse;
use Router\Legal\V1\V1TrademarkSearchResponse;
use Router\Legal\V1\V1VerifyResponse;
use Router\RequestOptions;
use Router\ServiceContracts\Legal\V1Contract;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public V1RawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
    }

    /**
     * @api
     *
     * Search for legal sources including cases, statutes, and regulations from authoritative legal databases. Returns ranked candidates. Always verify with legal.verify() before citing.
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
    ): V1FindResponse {
        $params = Util::removeNulls(
            [
                'query' => $query,
                'jurisdiction' => $jurisdiction,
                'numResults' => $numResults,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->find(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Parses legal citations from text and returns structured Bluebook components (case name, reporter, volume, page, year, court). Accepts either a single citation or a full text block.
     *
     * @param string $text Text containing citations to extract. Can be a single citation (e.g., "531 U.S. 98") or a full document with multiple citations.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getCitations(
        string $text,
        RequestOptions|array|null $requestOptions = null
    ): V1GetCitationsResponse {
        $params = Util::removeNulls(['text' => $text]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getCitations(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Extract all legal citations and references from a document URL. Returns structured citation data including case citations, statute references, and regulatory citations.
     *
     * @param string $url URL of the legal document to extract citations from
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getCitationsFromURL(
        string $url,
        RequestOptions|array|null $requestOptions = null
    ): V1GetCitationsFromURLResponse {
        $params = Util::removeNulls(['url' => $url]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getCitationsFromURL(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve the full text content of a legal document. Use after verifying the source with legal.verify(). Returns complete text with optional highlights and AI summary.
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
    ): V1GetFullTextResponse {
        $params = Util::removeNulls(
            [
                'url' => $url,
                'highlightQuery' => $highlightQuery,
                'maxCharacters' => $maxCharacters,
                'summaryQuery' => $summaryQuery,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getFullText(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Search for a jurisdiction by name. Returns matching jurisdictions with their IDs for use in legal.find() and other legal research endpoints.
     *
     * @param string $name Jurisdiction name (e.g., "California", "US Federal", "NY")
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listJurisdictions(
        string $name,
        RequestOptions|array|null $requestOptions = null
    ): V1ListJurisdictionsResponse {
        $params = Util::removeNulls(['name' => $name]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listJurisdictions(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Search the USPTO Open Data Portal for US patent applications and granted patents. Supports free-text queries, field-specific search, filters by assignee/inventor/status/type, date ranges, and pagination. Covers applications filed on or after January 1, 2001. Data is refreshed daily.
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
    ): V1PatentSearchResponse {
        $params = Util::removeNulls(
            [
                'query' => $query,
                'applicationStatus' => $applicationStatus,
                'applicationType' => $applicationType,
                'assignee' => $assignee,
                'filingDateFrom' => $filingDateFrom,
                'filingDateTo' => $filingDateTo,
                'grantDateFrom' => $grantDateFrom,
                'grantDateTo' => $grantDateTo,
                'inventor' => $inventor,
                'limit' => $limit,
                'offset' => $offset,
                'sortBy' => $sortBy,
                'sortOrder' => $sortOrder,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->patentSearch(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Perform comprehensive legal research with multiple query variations. Uses advanced deep search to find relevant sources across different phrasings of the legal issue.
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
    ): V1ResearchResponse {
        $params = Util::removeNulls(
            [
                'query' => $query,
                'additionalQueries' => $additionalQueries,
                'jurisdiction' => $jurisdiction,
                'numResults' => $numResults,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->research(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Find cases and documents similar to a given legal source. Useful for finding citing cases, related precedents, or similar statutes.
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
    ): V1SimilarResponse {
        $params = Util::removeNulls(
            [
                'url' => $url,
                'jurisdiction' => $jurisdiction,
                'numResults' => $numResults,
                'startPublishedDate' => $startPublishedDate,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->similar(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Look up trademark status and details from the USPTO Trademark Status & Document Retrieval (TSDR) system. Supports lookup by serial number or registration number. Returns mark text, status, owner, goods/services, Nice classification, filing/registration dates, and more.
     *
     * @param string $registrationNumber USPTO registration number (e.g. "6123456"). Provide either serialNumber or registrationNumber.
     * @param string $serialNumber USPTO serial number (e.g. "97123456"). Provide either serialNumber or registrationNumber.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function trademarkSearch(
        ?string $registrationNumber = null,
        ?string $serialNumber = null,
        RequestOptions|array|null $requestOptions = null,
    ): V1TrademarkSearchResponse {
        $params = Util::removeNulls(
            [
                'registrationNumber' => $registrationNumber,
                'serialNumber' => $serialNumber,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->trademarkSearch(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Validates legal citations against authoritative case law sources (CourtListener database of ~10M cases). Returns verification status and case metadata for each citation found in the input text. Accepts either a single citation or a full text block containing multiple citations.
     *
     * @param string $text Text containing citations to verify. Can be a single citation (e.g., "531 U.S. 98") or a full document with multiple citations.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function verify(
        string $text,
        RequestOptions|array|null $requestOptions = null
    ): V1VerifyResponse {
        $params = Util::removeNulls(['text' => $text]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->verify(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
