<?php

declare(strict_types=1);

namespace Casedev\Services\Legal;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Legal\V1\V1FindParams;
use Casedev\Legal\V1\V1FindResponse;
use Casedev\Legal\V1\V1GetCitationsFromURLParams;
use Casedev\Legal\V1\V1GetCitationsFromURLResponse;
use Casedev\Legal\V1\V1GetCitationsParams;
use Casedev\Legal\V1\V1GetCitationsResponse;
use Casedev\Legal\V1\V1GetFullTextParams;
use Casedev\Legal\V1\V1GetFullTextResponse;
use Casedev\Legal\V1\V1ListJurisdictionsParams;
use Casedev\Legal\V1\V1ListJurisdictionsResponse;
use Casedev\Legal\V1\V1ResearchParams;
use Casedev\Legal\V1\V1ResearchResponse;
use Casedev\Legal\V1\V1SimilarParams;
use Casedev\Legal\V1\V1SimilarResponse;
use Casedev\Legal\V1\V1VerifyParams;
use Casedev\Legal\V1\V1VerifyResponse;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Legal\V1RawContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
     * Search for legal sources including cases, statutes, and regulations from authoritative legal databases. Returns ranked candidates. Always verify with legal.verify() before citing.
     *
     * @param array{
     *   query: string, jurisdiction?: string, numResults?: int
     * }|V1FindParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1FindResponse>
     *
     * @throws APIException
     */
    public function find(
        array|V1FindParams $params,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = V1FindParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'legal/v1/find',
            body: (object) $parsed,
            options: $options,
            convert: V1FindResponse::class,
        );
    }

    /**
     * @api
     *
     * Parses legal citations from text and returns structured Bluebook components (case name, reporter, volume, page, year, court). Accepts either a single citation or a full text block.
     *
     * @param array{text: string}|V1GetCitationsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1GetCitationsResponse>
     *
     * @throws APIException
     */
    public function getCitations(
        array|V1GetCitationsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1GetCitationsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'legal/v1/citations',
            body: (object) $parsed,
            options: $options,
            convert: V1GetCitationsResponse::class,
        );
    }

    /**
     * @api
     *
     * Extract all legal citations and references from a document URL. Returns structured citation data including case citations, statute references, and regulatory citations.
     *
     * @param array{url: string}|V1GetCitationsFromURLParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1GetCitationsFromURLResponse>
     *
     * @throws APIException
     */
    public function getCitationsFromURL(
        array|V1GetCitationsFromURLParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1GetCitationsFromURLParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'legal/v1/citations-from-url',
            body: (object) $parsed,
            options: $options,
            convert: V1GetCitationsFromURLResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve the full text content of a legal document. Use after verifying the source with legal.verify(). Returns complete text with optional highlights and AI summary.
     *
     * @param array{
     *   url: string,
     *   highlightQuery?: string,
     *   maxCharacters?: int,
     *   summaryQuery?: string,
     * }|V1GetFullTextParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1GetFullTextResponse>
     *
     * @throws APIException
     */
    public function getFullText(
        array|V1GetFullTextParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1GetFullTextParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'legal/v1/full-text',
            body: (object) $parsed,
            options: $options,
            convert: V1GetFullTextResponse::class,
        );
    }

    /**
     * @api
     *
     * Search for a jurisdiction by name. Returns matching jurisdictions with their IDs for use in legal.find() and other legal research endpoints.
     *
     * @param array{name: string}|V1ListJurisdictionsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1ListJurisdictionsResponse>
     *
     * @throws APIException
     */
    public function listJurisdictions(
        array|V1ListJurisdictionsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1ListJurisdictionsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'legal/v1/jurisdictions',
            body: (object) $parsed,
            options: $options,
            convert: V1ListJurisdictionsResponse::class,
        );
    }

    /**
     * @api
     *
     * Perform comprehensive legal research with multiple query variations. Uses advanced deep search to find relevant sources across different phrasings of the legal issue.
     *
     * @param array{
     *   query: string,
     *   additionalQueries?: list<string>,
     *   jurisdiction?: string,
     *   numResults?: int,
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
            path: 'legal/v1/research',
            body: (object) $parsed,
            options: $options,
            convert: V1ResearchResponse::class,
        );
    }

    /**
     * @api
     *
     * Find cases and documents similar to a given legal source. Useful for finding citing cases, related precedents, or similar statutes.
     *
     * @param array{
     *   url: string,
     *   jurisdiction?: string,
     *   numResults?: int,
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
            path: 'legal/v1/similar',
            body: (object) $parsed,
            options: $options,
            convert: V1SimilarResponse::class,
        );
    }

    /**
     * @api
     *
     * Validates legal citations against authoritative case law sources (CourtListener database of ~10M cases). Returns verification status and case metadata for each citation found in the input text. Accepts either a single citation or a full text block containing multiple citations.
     *
     * @param array{text: string}|V1VerifyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1VerifyResponse>
     *
     * @throws APIException
     */
    public function verify(
        array|V1VerifyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1VerifyParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'legal/v1/verify',
            body: (object) $parsed,
            options: $options,
            convert: V1VerifyResponse::class,
        );
    }
}
