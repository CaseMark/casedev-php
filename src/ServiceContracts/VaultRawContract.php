<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Vault\VaultCreateParams;
use Casedev\Vault\VaultIngestParams;
use Casedev\Vault\VaultIngestResponse;
use Casedev\Vault\VaultListResponse;
use Casedev\Vault\VaultNewResponse;
use Casedev\Vault\VaultSearchParams;
use Casedev\Vault\VaultSearchResponse;
use Casedev\Vault\VaultUploadParams;
use Casedev\Vault\VaultUploadResponse;

interface VaultRawContract
{
    /**
     * @api
     *
     * @param array<mixed>|VaultCreateParams $params
     *
     * @return BaseResponse<VaultNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|VaultCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Unique identifier of the vault
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @return BaseResponse<VaultListResponse>
     *
     * @throws APIException
     */
    public function list(?RequestOptions $requestOptions = null): BaseResponse;

    /**
     * @api
     *
     * @param string $objectID Vault object ID
     * @param array<mixed>|VaultIngestParams $params
     *
     * @return BaseResponse<VaultIngestResponse>
     *
     * @throws APIException
     */
    public function ingest(
        string $objectID,
        array|VaultIngestParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Unique identifier of the vault to search
     * @param array<mixed>|VaultSearchParams $params
     *
     * @return BaseResponse<VaultSearchResponse>
     *
     * @throws APIException
     */
    public function search(
        string $id,
        array|VaultSearchParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Vault ID to upload the file to
     * @param array<mixed>|VaultUploadParams $params
     *
     * @return BaseResponse<VaultUploadResponse>
     *
     * @throws APIException
     */
    public function upload(
        string $id,
        array|VaultUploadParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
