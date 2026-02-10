<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Vault;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Vault\Multipart\MultipartGetPartURLsParams\Part;
use Casedev\Vault\Multipart\MultipartGetPartURLsResponse;

/**
 * @phpstan-import-type PartShape from \Casedev\Vault\Multipart\MultipartGetPartURLsParams\Part
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
    public function getPartURLs(
        string $id,
        string $objectID,
        array $parts,
        string $uploadID,
        RequestOptions|array|null $requestOptions = null,
    ): MultipartGetPartURLsResponse;
}
