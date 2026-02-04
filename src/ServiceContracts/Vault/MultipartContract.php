<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Vault;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Vault\Multipart\MultipartCompleteParams\Part;
use Casedev\Vault\Multipart\MultipartGetPartURLsResponse;
use Casedev\Vault\Multipart\MultipartInitResponse;

/**
 * @phpstan-import-type PartShape from \Casedev\Vault\Multipart\MultipartCompleteParams\Part
 * @phpstan-import-type PartShape from \Casedev\Vault\Multipart\MultipartGetPartURLsParams\Part as PartShape1
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface MultipartContract
{
    /**
     * @api
     *
     * @param string $id Vault ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function abort(
        string $id,
        string $objectID,
        string $uploadID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $id Vault ID
     * @param list<Part|PartShape> $parts
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function complete(
        string $id,
        string $objectID,
        array $parts,
        int $sizeBytes,
        string $uploadID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $id Vault ID
     * @param list<\Casedev\Vault\Multipart\MultipartGetPartURLsParams\Part|PartShape1> $parts
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getPartURLs(
        string $id,
        string $objectID,
        array $parts,
        string $uploadID,
        RequestOptions|array|null $requestOptions = null,
    ): MultipartGetPartURLsResponse;

    /**
     * @api
     *
     * @param string $id Vault ID to upload the file to
     * @param string $contentType MIME type of the file
     * @param string $filename Name of the file to upload
     * @param int $sizeBytes file size in bytes (required, max 8GB)
     * @param bool $autoIndex Whether to automatically process and index the file for search
     * @param mixed $metadata Additional metadata to associate with the file
     * @param int $partSizeBytes Multipart part size in bytes (min 5MB). Defaults to 64MB.
     * @param string $path Optional folder path for hierarchy preservation
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function init(
        string $id,
        string $contentType,
        string $filename,
        int $sizeBytes,
        bool $autoIndex = true,
        mixed $metadata = null,
        ?int $partSizeBytes = null,
        ?string $path = null,
        RequestOptions|array|null $requestOptions = null,
    ): MultipartInitResponse;
}
