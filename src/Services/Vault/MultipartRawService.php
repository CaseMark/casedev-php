<?php

declare(strict_types=1);

namespace Casedev\Services\Vault;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Vault\MultipartRawContract;
use Casedev\Vault\Multipart\MultipartAbortParams;
use Casedev\Vault\Multipart\MultipartCompleteParams;
use Casedev\Vault\Multipart\MultipartCompleteParams\Part;
use Casedev\Vault\Multipart\MultipartGetPartURLsParams;
use Casedev\Vault\Multipart\MultipartGetPartURLsResponse;
use Casedev\Vault\Multipart\MultipartInitParams;
use Casedev\Vault\Multipart\MultipartInitResponse;

/**
 * @phpstan-import-type PartShape from \Casedev\Vault\Multipart\MultipartCompleteParams\Part
 * @phpstan-import-type PartShape from \Casedev\Vault\Multipart\MultipartGetPartURLsParams\Part as PartShape1
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
     * Abort a multipart upload and discard uploaded parts.
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
     * Complete a multipart upload by providing the list of part numbers and ETags.
     *
     * @param string $id Vault ID
     * @param array{
     *   objectID: string,
     *   parts: list<Part|PartShape>,
     *   sizeBytes: int,
     *   uploadID: string,
     * }|MultipartCompleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function complete(
        string $id,
        array|MultipartCompleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MultipartCompleteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['vault/%1$s/multipart/complete', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Generate presigned URLs for individual multipart upload parts.
     *
     * @param string $id Vault ID
     * @param array{
     *   objectID: string,
     *   parts: list<MultipartGetPartURLsParams\Part|PartShape1>,
     *   uploadID: string,
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

    /**
     * @api
     *
     * Initiate a multipart upload for large files (>5GB). Returns an uploadId and object metadata. Use part URLs endpoint to upload parts and complete endpoint to finalize.
     *
     * @param string $id Vault ID to upload the file to
     * @param array{
     *   contentType: string,
     *   filename: string,
     *   sizeBytes: int,
     *   autoIndex?: bool,
     *   metadata?: mixed,
     *   partSizeBytes?: int,
     *   path?: string,
     * }|MultipartInitParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MultipartInitResponse>
     *
     * @throws APIException
     */
    public function init(
        string $id,
        array|MultipartInitParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MultipartInitParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['vault/%1$s/multipart/init', $id],
            body: (object) $parsed,
            options: $options,
            convert: MultipartInitResponse::class,
        );
    }
}
