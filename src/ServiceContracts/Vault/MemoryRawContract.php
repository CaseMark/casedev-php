<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Vault;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Vault\Memory\MemoryCreateParams;
use CaseDev\Vault\Memory\MemoryDeleteParams;
use CaseDev\Vault\Memory\MemoryListResponse;
use CaseDev\Vault\Memory\MemoryNewResponse;
use CaseDev\Vault\Memory\MemorySearchParams;
use CaseDev\Vault\Memory\MemorySearchResponse;
use CaseDev\Vault\Memory\MemoryUpdateParams;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface MemoryRawContract
{
    /**
     * @api
     *
     * @param string $id Vault ID
     * @param array<string,mixed>|MemoryCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MemoryNewResponse>
     *
     * @throws APIException
     */
    public function create(
        string $id,
        array|MemoryCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $entryID Path param: Memory entry ID
     * @param array<string,mixed>|MemoryUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $entryID,
        array|MemoryUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Vault ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MemoryListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $entryID Memory entry ID
     * @param array<string,mixed>|MemoryDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $entryID,
        array|MemoryDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Vault ID
     * @param array<string,mixed>|MemorySearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MemorySearchResponse>
     *
     * @throws APIException
     */
    public function search(
        string $id,
        array|MemorySearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
