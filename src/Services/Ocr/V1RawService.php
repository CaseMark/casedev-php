<?php

declare(strict_types=1);

namespace Casedev\Services\Ocr;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Ocr\V1\V1DownloadParams;
use Casedev\Ocr\V1\V1DownloadParams\Type;
use Casedev\Ocr\V1\V1ProcessParams;
use Casedev\Ocr\V1\V1ProcessParams\Engine;
use Casedev\Ocr\V1\V1ProcessResponse;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Ocr\V1RawContract;

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
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['ocr/v1/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Download OCR processing results in various formats. Returns the processed document as text extraction, structured JSON with coordinates, searchable PDF with text layer, or the original uploaded document.
     *
     * @param Type|value-of<Type> $type Format to download: `text` (plain text), `json` (structured data with coordinates), `pdf` (searchable PDF with text layer), `original` (original uploaded document)
     * @param array{id: string}|V1DownloadParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function download(
        Type|string $type,
        array|V1DownloadParams $params,
        ?RequestOptions $requestOptions = null,
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
            options: $options,
            convert: null,
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
     *   engine?: 'doctr'|'paddleocr'|Engine,
     *   features?: array{forms?: bool, layout?: bool, tables?: bool, text?: bool},
     *   resultBucket?: string,
     *   resultPrefix?: string,
     * }|V1ProcessParams $params
     *
     * @return BaseResponse<V1ProcessResponse>
     *
     * @throws APIException
     */
    public function process(
        array|V1ProcessParams $params,
        ?RequestOptions $requestOptions = null
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
