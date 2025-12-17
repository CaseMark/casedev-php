<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Search;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Search\V1\V1AnswerParams;
use Casedev\Search\V1\V1AnswerResponse;
use Casedev\Search\V1\V1ContentsParams;
use Casedev\Search\V1\V1ContentsResponse;
use Casedev\Search\V1\V1ResearchParams;
use Casedev\Search\V1\V1ResearchResponse;
use Casedev\Search\V1\V1RetrieveResearchParams;
use Casedev\Search\V1\V1SearchParams;
use Casedev\Search\V1\V1SearchResponse;
use Casedev\Search\V1\V1SimilarParams;
use Casedev\Search\V1\V1SimilarResponse;

interface V1RawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|V1AnswerParams $params
     *
     * @return BaseResponse<V1AnswerResponse>
     *
     * @throws APIException
     */
    public function answer(
        array|V1AnswerParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1ContentsParams $params
     *
     * @return BaseResponse<V1ContentsResponse>
     *
     * @throws APIException
     */
    public function contents(
        array|V1ContentsParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1ResearchParams $params
     *
     * @return BaseResponse<V1ResearchResponse>
     *
     * @throws APIException
     */
    public function research(
        array|V1ResearchParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Unique identifier for the research task
     * @param array<string,mixed>|V1RetrieveResearchParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieveResearch(
        string $id,
        array|V1RetrieveResearchParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1SearchParams $params
     *
     * @return BaseResponse<V1SearchResponse>
     *
     * @throws APIException
     */
    public function search(
        array|V1SearchParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1SimilarParams $params
     *
     * @return BaseResponse<V1SimilarResponse>
     *
     * @throws APIException
     */
    public function similar(
        array|V1SimilarParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
