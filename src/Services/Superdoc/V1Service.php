<?php

declare(strict_types=1);

namespace Casedev\Services\Superdoc;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Superdoc\V1Contract;
use Casedev\Superdoc\V1\V1AnnotateParams\Document;
use Casedev\Superdoc\V1\V1AnnotateParams\Field;
use Casedev\Superdoc\V1\V1AnnotateParams\OutputFormat;
use Casedev\Superdoc\V1\V1ConvertParams\From;
use Casedev\Superdoc\V1\V1ConvertParams\To;

/**
 * @phpstan-import-type DocumentShape from \Casedev\Superdoc\V1\V1AnnotateParams\Document
 * @phpstan-import-type FieldShape from \Casedev\Superdoc\V1\V1AnnotateParams\Field
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
     * Populate fields inside a DOCX template using SuperDoc annotations. Supports text, images, dates, and numbers. Can target individual fields by ID or multiple fields by group.
     *
     * @param Document|DocumentShape $document Document source - provide either URL or base64
     * @param list<Field|FieldShape> $fields Fields to populate in the template
     * @param OutputFormat|value-of<OutputFormat> $outputFormat Output format for the annotated document
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function annotate(
        Document|array $document,
        array $fields,
        OutputFormat|string $outputFormat = 'docx',
        RequestOptions|array|null $requestOptions = null,
    ): string {
        $params = Util::removeNulls(
            [
                'document' => $document,
                'fields' => $fields,
                'outputFormat' => $outputFormat,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->annotate(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Convert documents between formats using SuperDoc. Supports DOCX to PDF, Markdown to DOCX, and HTML to DOCX conversions.
     *
     * @param From|value-of<From> $from Source format of the document
     * @param string $documentBase64 Base64-encoded document content
     * @param string $documentURL URL to the document to convert
     * @param To|value-of<To> $to Target format for conversion
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function convert(
        From|string $from,
        ?string $documentBase64 = null,
        ?string $documentURL = null,
        To|string $to = 'pdf',
        RequestOptions|array|null $requestOptions = null,
    ): string {
        $params = Util::removeNulls(
            [
                'from' => $from,
                'documentBase64' => $documentBase64,
                'documentURL' => $documentURL,
                'to' => $to,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->convert(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
