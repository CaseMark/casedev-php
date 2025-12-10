<?php

declare(strict_types=1);

namespace Casedev\Services\Format;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Format\V1\V1CreateDocumentParams\InputFormat;
use Casedev\Format\V1\V1CreateDocumentParams\OutputFormat;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Format\V1Contract;
use Casedev\Services\Format\V1\TemplatesService;

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
    ): string {
        $params = [
            'content' => $content,
            'outputFormat' => $outputFormat,
            'inputFormat' => $inputFormat,
            'options' => $options,
        ];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createDocument(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
