<?php

declare(strict_types=1);

namespace Router\Services\Format;

use Router\Client;
use Router\Core\Exceptions\APIException;
use Router\Core\Util;
use Router\Format\V1\V1CreateDocumentParams\InputFormat;
use Router\Format\V1\V1CreateDocumentParams\Options;
use Router\Format\V1\V1CreateDocumentParams\OutputFormat;
use Router\RequestOptions;
use Router\ServiceContracts\Format\V1Contract;
use Router\Services\Format\V1\TemplatesService;

/**
 * @phpstan-import-type OptionsShape from \Router\Format\V1\V1CreateDocumentParams\Options
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public V1RawService $raw;

    /**
     * @api
     */
    public TemplatesService $templates;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
        $this->templates = new TemplatesService($client);
    }

    /**
     * @api
     *
     * Convert Markdown, JSON, or text content to professionally formatted PDF, DOCX, or HTML documents. Supports template components with variable interpolation for creating consistent legal documents like contracts, briefs, and reports.
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
    ): string {
        $params = Util::removeNulls(
            [
                'content' => $content,
                'outputFormat' => $outputFormat,
                'inputFormat' => $inputFormat,
                'options' => $options,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createDocument(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
