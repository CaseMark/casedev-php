<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Ocr;

use Casedev\Core\Exceptions\APIException;
use Casedev\Ocr\V1\V1DownloadParams\Type;
use Casedev\Ocr\V1\V1ProcessParams\Engine;
use Casedev\Ocr\V1\V1ProcessResponse;
use Casedev\RequestOptions;

interface V1Contract
{
    /**
     * @api
     *
     * @param string $id The OCR job ID returned from the create OCR endpoint
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param Type|value-of<Type> $type Format to download: `text` (plain text), `json` (structured data with coordinates), `pdf` (searchable PDF with text layer), `original` (original uploaded document)
     * @param string $id OCR job ID returned from the initial OCR request
     *
     * @throws APIException
     */
    public function download(
        Type|string $type,
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $documentURL URL or S3 path to the document to process
     * @param string $callbackURL URL to receive completion webhook
     * @param string $documentID Optional custom document identifier
     * @param 'doctr'|'paddleocr'|Engine $engine OCR engine to use
     * @param array{
     *   forms?: bool, layout?: bool, tables?: bool, text?: bool
     * } $features OCR features to extract
     * @param string $resultBucket S3 bucket to store results
     * @param string $resultPrefix S3 key prefix for results
     *
     * @throws APIException
     */
    public function process(
        string $documentURL,
        ?string $callbackURL = null,
        ?string $documentID = null,
        string|Engine $engine = 'doctr',
        ?array $features = null,
        ?string $resultBucket = null,
        ?string $resultPrefix = null,
        ?RequestOptions $requestOptions = null,
    ): V1ProcessResponse;
}
