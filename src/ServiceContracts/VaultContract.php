<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts;

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

interface VaultContract
{
    /**
     * @api
     *
     * @param array<mixed>|VaultCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|VaultCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): VaultNewResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @throws APIException
     */
    public function list(
        ?RequestOptions $requestOptions = null
    ): VaultListResponse;

    /**
     * @api
     *
     * @param array<mixed>|VaultIngestParams $params
     *
     * @throws APIException
     */
    public function ingest(
        string $objectID,
        array|VaultIngestParams $params,
        ?RequestOptions $requestOptions = null,
    ): VaultIngestResponse;

    /**
     * @api
     *
     * @param array<mixed>|VaultSearchParams $params
     *
     * @throws APIException
     */
    public function search(
        string $id,
        array|VaultSearchParams $params,
        ?RequestOptions $requestOptions = null,
    ): VaultSearchResponse;

    /**
     * @api
     *
     * @param array<mixed>|VaultUploadParams $params
     *
     * @throws APIException
     */
    public function upload(
        string $id,
        array|VaultUploadParams $params,
        ?RequestOptions $requestOptions = null,
    ): VaultUploadResponse;
}
