<?php

declare(strict_types=1);

namespace Router\Services\Ocr;

use Router\Client;
use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\Ocr\V1\V1DownloadParams;
use Router\Ocr\V1\V1DownloadParams\Type;
use Router\Ocr\V1\V1GetResponse;
use Router\Ocr\V1\V1ProcessParams;
use Router\Ocr\V1\V1ProcessParams\Engine;
use Router\Ocr\V1\V1ProcessParams\Features;
use Router\Ocr\V1\V1ProcessResponse;
use Router\RequestOptions;
use Router\ServiceContracts\Ocr\V1RawContract;

/**
 * @phpstan-import-type FeaturesShape from \Router\Ocr\V1\V1ProcessParams\Features
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
final class V1RawService implements V1RawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve the status and results of an OCR job. Returns job progress, extracted text, and metadata when processing is complete.
     *
     * @param string $id The OCR job ID returned from the create OCR endpoint
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1GetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['ocr/v1/%1$s', $id],
            options: $requestOptions,
            convert: V1GetResponse::class,
        );
    }

    /**
     * @api
     *
     * Download OCR processing results in various formats. Returns the processed document as text extraction, structured JSON with coordinates, searchable PDF with text layer, or the original uploaded document.
     *
     * @param Type|value-of<Type> $type Format to download: `text` (plain text), `json` (structured data with coordinates), `pdf` (searchable PDF with text layer), `original` (original uploaded document)
     * @param array{id: string}|V1DownloadParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function download(
        Type|string $type,
        array|V1DownloadParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1DownloadParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['ocr/v1/%1$s/download/%2$s', $id, $type],
            headers: ['Accept' => 'application/octet-stream'],
            options: $options,
            convert: 'string',
        );
    }

    /**
     * @api
     *
     * Submit a document for OCR processing to extract text, detect tables, forms, and other features. Supports PDFs, images, and scanned documents. Returns a job ID that can be used to track processing status.
     *
     * @param array{
     *   documentURL: string,
     *   callbackURL?: string,
     *   documentID?: string,
     *   engine?: Engine|value-of<Engine>,
     *   features?: Features|FeaturesShape,
     *   resultBucket?: string,
     *   resultPrefix?: string,
     * }|V1ProcessParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1ProcessResponse>
     *
     * @throws APIException
     */
    public function process(
        array|V1ProcessParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1ProcessParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'ocr/v1/process',
            body: (object) $parsed,
            options: $options,
            convert: V1ProcessResponse::class,
        );
    }
}
