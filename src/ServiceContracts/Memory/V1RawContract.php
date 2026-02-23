<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Memory;

use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\Memory\V1\V1CreateParams;
use Router\Memory\V1\V1DeleteAllParams;
use Router\Memory\V1\V1DeleteAllResponse;
use Router\Memory\V1\V1DeleteResponse;
use Router\Memory\V1\V1GetResponse;
use Router\Memory\V1\V1ListParams;
use Router\Memory\V1\V1ListResponse;
use Router\Memory\V1\V1NewResponse;
use Router\Memory\V1\V1SearchParams;
use Router\Memory\V1\V1SearchResponse;
use Router\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
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
