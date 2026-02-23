<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Format;

use Router\Core\Exceptions\APIException;
use Router\Format\V1\V1CreateDocumentParams\InputFormat;
use Router\Format\V1\V1CreateDocumentParams\Options;
use Router\Format\V1\V1CreateDocumentParams\OutputFormat;
use Router\RequestOptions;

/**
 * @phpstan-import-type OptionsShape from \Router\Format\V1\V1CreateDocumentParams\Options
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
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
