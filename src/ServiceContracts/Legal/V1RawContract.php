<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Legal;

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
use Casedev\Legal\V1\V1PatentSearchParams;
use Casedev\Legal\V1\V1PatentSearchResponse;
use Casedev\Legal\V1\V1ResearchParams;
use Casedev\Legal\V1\V1ResearchResponse;
use Casedev\Legal\V1\V1SimilarParams;
use Casedev\Legal\V1\V1SimilarResponse;
use Casedev\Legal\V1\V1VerifyParams;
use Casedev\Legal\V1\V1VerifyResponse;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface V1RawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|V1FindParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1FindResponse>
     *
     * @throws APIException
     */
    public function find(
        array|V1FindParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1GetCitationsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1GetCitationsResponse>
     *
     * @throws APIException
     */
    public function getCitations(
        array|V1GetCitationsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1GetCitationsFromURLParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1GetCitationsFromURLResponse>
     *
     * @throws APIException
     */
    public function getCitationsFromURL(
        array|V1GetCitationsFromURLParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1GetFullTextParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1GetFullTextResponse>
     *
     * @throws APIException
     */
    public function getFullText(
        array|V1GetFullTextParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1ListJurisdictionsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1ListJurisdictionsResponse>
     *
     * @throws APIException
     */
    public function listJurisdictions(
        array|V1ListJurisdictionsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1PatentSearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1PatentSearchResponse>
     *
     * @throws APIException
     */
    public function patentSearch(
        array|V1PatentSearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1ResearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1ResearchResponse>
     *
     * @throws APIException
     */
    public function research(
        array|V1ResearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1SimilarParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1SimilarResponse>
     *
     * @throws APIException
     */
    public function similar(
        array|V1SimilarParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1VerifyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1VerifyResponse>
     *
     * @throws APIException
     */
    public function verify(
        array|V1VerifyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
