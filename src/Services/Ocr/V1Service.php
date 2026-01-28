<?php

declare(strict_types=1);

namespace Casedev\Services\Ocr;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\Ocr\V1\V1DownloadParams\Type;
use Casedev\Ocr\V1\V1GetResponse;
use Casedev\Ocr\V1\V1ProcessParams\Engine;
use Casedev\Ocr\V1\V1ProcessParams\Features;
use Casedev\Ocr\V1\V1ProcessResponse;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Ocr\V1Contract;

/**
 * @phpstan-import-type FeaturesShape from \Casedev\Ocr\V1\V1ProcessParams\Features
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public V1RawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
    }

    /**
     * @api
     *
     * Retrieve the status and results of an OCR job. Returns job progress, extracted text, and metadata when processing is complete.
     *
     * @param string $id The OCR job ID returned from the create OCR endpoint
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): V1GetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Download OCR processing results in various formats. Returns the processed document as text extraction, structured JSON with coordinates, searchable PDF with text layer, or the original uploaded document.
     *
     * @param Type|value-of<Type> $type Format to download: `text` (plain text), `json` (structured data with coordinates), `pdf` (searchable PDF with text layer), `original` (original uploaded document)
     * @param string $id OCR job ID returned from the initial OCR request
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function download(
        Type|string $type,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): string {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->download($type, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Submit a document for OCR processing to extract text, detect tables, forms, and other features. Supports PDFs, images, and scanned documents. Returns a job ID that can be used to track processing status.
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
    ): V1ProcessResponse {
        $params = Util::removeNulls(
            [
                'documentURL' => $documentURL,
                'callbackURL' => $callbackURL,
                'documentID' => $documentID,
                'engine' => $engine,
                'features' => $features,
                'resultBucket' => $resultBucket,
                'resultPrefix' => $resultPrefix,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->process(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
