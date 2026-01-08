<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Format;

use Casedev\Core\Exceptions\APIException;
use Casedev\Format\V1\V1CreateDocumentParams\InputFormat;
use Casedev\Format\V1\V1CreateDocumentParams\Options;
use Casedev\Format\V1\V1CreateDocumentParams\OutputFormat;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type OptionsShape from \Casedev\Format\V1\V1CreateDocumentParams\Options
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface V1Contract
{
    /**
     * @api
     *
     * @param string $content The source content to format
     * @param OutputFormat|value-of<OutputFormat> $outputFormat Desired output format
     * @param InputFormat|value-of<InputFormat> $inputFormat Format of the input content
     * @param Options|OptionsShape $options
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createDocument(
        string $content,
        OutputFormat|string $outputFormat,
        InputFormat|string $inputFormat = 'md',
        Options|array|null $options = null,
        RequestOptions|array|null $requestOptions = null,
    ): string;
}
