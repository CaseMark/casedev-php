<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Vault;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Vault\Objects\ObjectCreatePresignedURLParams;
use Casedev\Vault\Objects\ObjectDownloadParams;
use Casedev\Vault\Objects\ObjectGetTextParams;
use Casedev\Vault\Objects\ObjectNewPresignedURLResponse;
use Casedev\Vault\Objects\ObjectRetrieveParams;

interface ObjectsContract
{
    /**
     * @api
     *
     * @param array<mixed>|ObjectRetrieveParams $params
     *
     * @throws APIException
     */
    public function retrieve(
        string $objectID,
        array|ObjectRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @throws APIException
     */
    public function list(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|ObjectCreatePresignedURLParams $params
     *
     * @throws APIException
     */
    public function createPresignedURL(
        string $objectID,
        array|ObjectCreatePresignedURLParams $params,
        ?RequestOptions $requestOptions = null,
    ): ObjectNewPresignedURLResponse;

    /**
     * @api
     *
     * @param array<mixed>|ObjectDownloadParams $params
     *
     * @throws APIException
     */
    public function download(
        string $objectID,
        array|ObjectDownloadParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|ObjectGetTextParams $params
     *
     * @throws APIException
     */
    public function getText(
        string $objectID,
        array|ObjectGetTextParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;
}
