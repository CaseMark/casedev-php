<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Memory;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Memory\V1\V1CreateParams;
use CaseDev\Memory\V1\V1DeleteAllParams;
use CaseDev\Memory\V1\V1DeleteAllResponse;
use CaseDev\Memory\V1\V1DeleteResponse;
use CaseDev\Memory\V1\V1GetResponse;
use CaseDev\Memory\V1\V1ListParams;
use CaseDev\Memory\V1\V1ListResponse;
use CaseDev\Memory\V1\V1NewResponse;
use CaseDev\Memory\V1\V1SearchParams;
use CaseDev\Memory\V1\V1SearchResponse;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
