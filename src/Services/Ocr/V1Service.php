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
use Casedev\ServiceContracts\Ocr\V1Contract;

final class V1Service implements V1Contract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve the status and results of an OCR job. Returns job progress, extracted text, and metadata when processing is complete.
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'get',
            path: ['ocr/v1/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Download OCR processing results in various formats. Returns the processed document as text extraction, structured JSON with coordinates, searchable PDF with text layer, or the original uploaded document.
     *
     * @param Type|value-of<Type> $type
     * @param array{id: string}|V1DownloadParams $params
     *
     * @throws APIException
     */
    public function download(
        Type|string $type,
        array|V1DownloadParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = V1DownloadParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'get',
            path: ['ocr/v1/%1$s/download/%2$s', $id, $type],
            options: $options,
            convert: null,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Submit a document for OCR processing to extract text, detect tables, forms, and other features. Supports PDFs, images, and scanned documents. Returns a job ID that can be used to track processing status.
     *
     * @param array{
     *   document_url: string,
     *   callback_url?: string,
     *   document_id?: string,
     *   engine?: 'doctr'|'paddleocr'|Engine,
     *   features?: array{forms?: bool, layout?: bool, tables?: bool, text?: bool},
     *   result_bucket?: string,
     *   result_prefix?: string,
     * }|V1ProcessParams $params
     *
     * @throws APIException
     */
    public function process(
        array|V1ProcessParams $params,
        ?RequestOptions $requestOptions = null
    ): V1ProcessResponse {
        [$parsed, $options] = V1ProcessParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<V1ProcessResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'ocr/v1/process',
            body: (object) $parsed,
            options: $options,
            convert: V1ProcessResponse::class,
        );

        return $response->parse();
    }
}
