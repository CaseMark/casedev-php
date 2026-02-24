<?php

declare(strict_types=1);

namespace CaseDev\Services\Vault;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Vault\MultipartRawContract;
use CaseDev\Vault\Multipart\MultipartAbortParams;
use CaseDev\Vault\Multipart\MultipartGetPartURLsParams;
use CaseDev\Vault\Multipart\MultipartGetPartURLsParams\Part;
use CaseDev\Vault\Multipart\MultipartGetPartURLsResponse;

/**
 * @phpstan-import-type PartShape from \CaseDev\Vault\Multipart\MultipartGetPartURLsParams\Part
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class MultipartRawService implements MultipartRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Abort a multipart upload and discard uploaded parts (live).
     *
     * @param string $id Vault ID
     * @param array{objectID: string, uploadID: string}|MultipartAbortParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function abort(
        string $id,
        array|MultipartAbortParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MultipartAbortParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['vault/%1$s/multipart/abort', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Generate presigned URLs for individual multipart upload parts (live).
     *
     * @param string $id Vault ID
     * @param array{
     *   objectID: string, parts: list<Part|PartShape>, uploadID: string
     * }|MultipartGetPartURLsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MultipartGetPartURLsResponse>
     *
     * @throws APIException
     */
    public function getPartURLs(
        string $id,
        array|MultipartGetPartURLsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MultipartGetPartURLsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['vault/%1$s/multipart/part-urls', $id],
            body: (object) $parsed,
            options: $options,
            convert: MultipartGetPartURLsResponse::class,
        );
    }
}
