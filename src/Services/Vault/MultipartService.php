<?php

declare(strict_types=1);

namespace CaseDev\Services\Vault;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Vault\MultipartContract;
use CaseDev\Vault\Multipart\MultipartGetPartURLsParams\Part;
use CaseDev\Vault\Multipart\MultipartGetPartURLsResponse;

/**
 * @phpstan-import-type PartShape from \CaseDev\Vault\Multipart\MultipartGetPartURLsParams\Part
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class MultipartService implements MultipartContract
{
    /**
     * @api
     */
    public MultipartRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new MultipartRawService($client);
    }

    /**
     * @api
     *
     * Abort a multipart upload and discard uploaded parts (live).
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
    ): mixed {
        $params = Util::removeNulls(
            ['objectID' => $objectID, 'uploadID' => $uploadID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->abort($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Generate presigned URLs for individual multipart upload parts (live).
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
    ): MultipartGetPartURLsResponse {
        $params = Util::removeNulls(
            ['objectID' => $objectID, 'parts' => $parts, 'uploadID' => $uploadID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getPartURLs($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
