<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Search;

use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\RequestOptions;
use Router\Search\V1\V1AnswerParams;
use Router\Search\V1\V1AnswerResponse;
use Router\Search\V1\V1ContentsParams;
use Router\Search\V1\V1ContentsResponse;
use Router\Search\V1\V1GetResearchResponse;
use Router\Search\V1\V1ResearchParams;
use Router\Search\V1\V1ResearchResponse;
use Router\Search\V1\V1RetrieveResearchParams;
use Router\Search\V1\V1SearchParams;
use Router\Search\V1\V1SearchResponse;
use Router\Search\V1\V1SimilarParams;
use Router\Search\V1\V1SimilarResponse;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
interface V1RawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|V1AnswerParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1AnswerResponse>
     *
     * @throws APIException
     */
    public function answer(
        array|V1AnswerParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1ContentsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1ContentsResponse>
     *
     * @throws APIException
     */
    public function contents(
        array|V1ContentsParams $params,
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
     * @param string $id Unique identifier for the research task
     * @param array<string,mixed>|V1RetrieveResearchParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1SearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1SearchResponse>
     *
     * @throws APIException
     */
    public function search(
        array|V1SearchParams $params,
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
}
