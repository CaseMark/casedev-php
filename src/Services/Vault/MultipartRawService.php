<?php

declare(strict_types=1);

namespace Casedev\Services\Vault;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Vault\MultipartRawContract;
use Casedev\Vault\Multipart\MultipartAbortParams;
use Casedev\Vault\Multipart\MultipartGetPartURLsParams;
use Casedev\Vault\Multipart\MultipartGetPartURLsParams\Part;
use Casedev\Vault\Multipart\MultipartGetPartURLsResponse;

/**
 * @phpstan-import-type PartShape from \Casedev\Vault\Multipart\MultipartGetPartURLsParams\Part
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
