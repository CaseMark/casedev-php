<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Format;

use Casedev\Core\Exceptions\APIException;
use Casedev\Format\V1\V1CreateDocumentParams\InputFormat;
use Casedev\Format\V1\V1CreateDocumentParams\OutputFormat;
use Casedev\RequestOptions;

interface V1Contract
{
    /**
     * @api
     *
     * @param string $content The source content to format
     * @param 'pdf'|'docx'|'html_preview'|OutputFormat $outputFormat Desired output format
     * @param 'md'|'json'|'text'|InputFormat $inputFormat Format of the input content
     * @param array{
     *   components?: list<array{
     *     content?: string, styles?: mixed, templateID?: string, variables?: mixed
     *   }>,
     * } $options
     *
     * @throws APIException
     */
    public function createDocument(
        string $content,
        string|OutputFormat $outputFormat,
        string|InputFormat $inputFormat = 'md',
        ?array $options = null,
        ?RequestOptions $requestOptions = null,
    ): string;
}
