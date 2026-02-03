<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Memory;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Memory\V1\V1CreateParams;
use Casedev\Memory\V1\V1DeleteAllParams;
use Casedev\Memory\V1\V1DeleteAllResponse;
use Casedev\Memory\V1\V1DeleteResponse;
use Casedev\Memory\V1\V1GetResponse;
use Casedev\Memory\V1\V1ListParams;
use Casedev\Memory\V1\V1ListResponse;
use Casedev\Memory\V1\V1NewResponse;
use Casedev\Memory\V1\V1SearchParams;
use Casedev\Memory\V1\V1SearchResponse;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface V1RawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|V1CreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1NewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|V1CreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Memory ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1GetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1ListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1ListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|V1ListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Memory ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1DeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1DeleteAllParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1DeleteAllResponse>
     *
     * @throws APIException
     */
    public function deleteAll(
        array|V1DeleteAllParams $params,
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
}
