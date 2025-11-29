<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Search;

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

interface V1Contract
{
    /**
     * @api
     *
     * @param array<mixed>|V1AnswerParams $params
     *
     * @throws APIException
     */
    public function answer(
        array|V1AnswerParams $params,
        ?RequestOptions $requestOptions = null
    ): V1AnswerResponse;

    /**
     * @api
     *
     * @param array<mixed>|V1ContentsParams $params
     *
     * @throws APIException
     */
    public function contents(
        array|V1ContentsParams $params,
        ?RequestOptions $requestOptions = null
    ): V1ContentsResponse;

    /**
     * @api
     *
     * @param array<mixed>|V1ResearchParams $params
     *
     * @throws APIException
     */
    public function research(
        array|V1ResearchParams $params,
        ?RequestOptions $requestOptions = null
    ): V1ResearchResponse;

    /**
     * @api
     *
     * @param array<mixed>|V1RetrieveResearchParams $params
     *
     * @throws APIException
     */
    public function retrieveResearch(
        string $id,
        array|V1RetrieveResearchParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|V1SearchParams $params
     *
     * @throws APIException
     */
    public function search(
        array|V1SearchParams $params,
        ?RequestOptions $requestOptions = null
    ): V1SearchResponse;

    /**
     * @api
     *
     * @param array<mixed>|V1SimilarParams $params
     *
     * @throws APIException
     */
    public function similar(
        array|V1SimilarParams $params,
        ?RequestOptions $requestOptions = null
    ): V1SimilarResponse;
}
