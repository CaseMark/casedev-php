<?php

declare(strict_types=1);

namespace Casedev\Services\Legal;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\Legal\V1\V1FindResponse;
use Casedev\Legal\V1\V1GetCitationsFromURLResponse;
use Casedev\Legal\V1\V1GetCitationsResponse;
use Casedev\Legal\V1\V1GetFullTextResponse;
use Casedev\Legal\V1\V1ListJurisdictionsResponse;
use Casedev\Legal\V1\V1ResearchResponse;
use Casedev\Legal\V1\V1SimilarResponse;
use Casedev\Legal\V1\V1VerifyResponse;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Legal\V1Contract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
