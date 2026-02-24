<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Vault\VaultConfirmUploadParams;
use CaseDev\Vault\VaultConfirmUploadResponse;
use CaseDev\Vault\VaultCreateParams;
use CaseDev\Vault\VaultDeleteParams;
use CaseDev\Vault\VaultDeleteResponse;
use CaseDev\Vault\VaultGetResponse;
use CaseDev\Vault\VaultIngestParams;
use CaseDev\Vault\VaultIngestResponse;
use CaseDev\Vault\VaultListResponse;
use CaseDev\Vault\VaultNewResponse;
use CaseDev\Vault\VaultSearchParams;
use CaseDev\Vault\VaultSearchResponse;
use CaseDev\Vault\VaultUpdateParams;
use CaseDev\Vault\VaultUpdateResponse;
use CaseDev\Vault\VaultUploadParams;
use CaseDev\Vault\VaultUploadResponse;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface VaultRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|VaultCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VaultNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|VaultCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Unique identifier of the vault
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VaultGetResponse>
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
     * @param string $id Vault ID to update
     * @param array<string,mixed>|VaultUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VaultUpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|VaultUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VaultListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Vault ID to delete
     * @param array<string,mixed>|VaultDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VaultDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        array|VaultDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $objectID Path param: Vault object ID
     * @param array<string,mixed>|VaultConfirmUploadParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VaultConfirmUploadResponse>
     *
     * @throws APIException
     */
    public function confirmUpload(
        string $objectID,
        array|VaultConfirmUploadParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $objectID Vault object ID
     * @param array<string,mixed>|VaultIngestParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VaultIngestResponse>
     *
     * @throws APIException
     */
    public function ingest(
        string $objectID,
        array|VaultIngestParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Unique identifier of the vault to search
     * @param array<string,mixed>|VaultSearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VaultSearchResponse>
     *
     * @throws APIException
     */
    public function search(
        string $id,
        array|VaultSearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Vault ID to upload the file to
     * @param array<string,mixed>|VaultUploadParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VaultUploadResponse>
     *
     * @throws APIException
     */
    public function upload(
        string $id,
        array|VaultUploadParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
