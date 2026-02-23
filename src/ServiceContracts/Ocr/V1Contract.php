<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Ocr;

use Router\Core\Exceptions\APIException;
use Router\Ocr\V1\V1DownloadParams\Type;
use Router\Ocr\V1\V1GetResponse;
use Router\Ocr\V1\V1ProcessParams\Engine;
use Router\Ocr\V1\V1ProcessParams\Features;
use Router\Ocr\V1\V1ProcessResponse;
use Router\RequestOptions;

/**
 * @phpstan-import-type FeaturesShape from \Router\Ocr\V1\V1ProcessParams\Features
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
interface V1Contract
{
    /**
     * @api
     *
     * @param string $id The OCR job ID returned from the create OCR endpoint
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): V1GetResponse;

    /**
     * @api
     *
     * @param Type|string $type Format to download: `text` (plain text), `json` (structured data with coordinates), `pdf` (searchable PDF with text layer), `original` (original uploaded document)
     * @param string $id OCR job ID returned from the initial OCR request
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function download(
        Type|string $type,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): string;

    /**
     * @api
     *
     * @param string $documentURL URL or S3 path to the document to process
     * @param string $callbackURL URL to receive completion webhook
     * @param string $documentID Optional custom document identifier
     * @param Engine|value-of<Engine> $engine OCR engine to use
     * @param Features|FeaturesShape $features Additional processing options
     * @param string $resultBucket S3 bucket to store results
     * @param string $resultPrefix S3 key prefix for results
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function process(
        string $documentURL,
        ?string $callbackURL = null,
        ?string $documentID = null,
        Engine|string $engine = 'doctr',
        Features|array|null $features = null,
        ?string $resultBucket = null,
        ?string $resultPrefix = null,
        RequestOptions|array|null $requestOptions = null,
    ): V1ProcessResponse;
}
