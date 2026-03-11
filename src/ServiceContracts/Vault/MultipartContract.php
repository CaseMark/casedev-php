<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Vault;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Vault\Multipart\MultipartGetPartURLsParams\Part;
use CaseDev\Vault\Multipart\MultipartGetPartURLsResponse;

/**
 * @phpstan-import-type PartShape from \CaseDev\Vault\Multipart\MultipartGetPartURLsParams\Part
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface MultipartContract
{
    /**
     * @api
     *
     * @param string $id Vault ID
     * @param string $objectID Vault object ID associated with the multipart upload
     * @param string $uploadID Multipart upload ID returned when the upload was initialized
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
     * @param string $objectID Vault object ID associated with the multipart upload
     * @param list<Part|PartShape> $parts Multipart parts that need presigned upload URLs
     * @param string $uploadID Multipart upload ID returned when the upload was initialized
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
}
