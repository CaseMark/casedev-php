<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Superdoc;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Superdoc\V1\V1AnnotateParams\Document;
use CaseDev\Superdoc\V1\V1AnnotateParams\Field;
use CaseDev\Superdoc\V1\V1AnnotateParams\OutputFormat;
use CaseDev\Superdoc\V1\V1ConvertParams\From;
use CaseDev\Superdoc\V1\V1ConvertParams\To;

/**
 * @phpstan-import-type DocumentShape from \CaseDev\Superdoc\V1\V1AnnotateParams\Document
 * @phpstan-import-type FieldShape from \CaseDev\Superdoc\V1\V1AnnotateParams\Field
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface V1Contract
{
    /**
     * @api
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
    ): string;

    /**
     * @api
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
    ): string;
}
