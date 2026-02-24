<?php

declare(strict_types=1);

namespace CaseDev\Services\Format;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\Format\V1\V1CreateDocumentParams\InputFormat;
use CaseDev\Format\V1\V1CreateDocumentParams\Options;
use CaseDev\Format\V1\V1CreateDocumentParams\OutputFormat;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Format\V1Contract;
use CaseDev\Services\Format\V1\TemplatesService;

/**
 * @phpstan-import-type OptionsShape from \CaseDev\Format\V1\V1CreateDocumentParams\Options
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
