<?php

declare(strict_types=1);

namespace Casedev\Services\Format;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Format\V1\V1CreateDocumentParams;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Format\V1Contract;
use Casedev\Services\Format\V1\TemplatesService;

final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public TemplatesService $templates;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->templates = new TemplatesService($client);
    }

    /**
     * @api
     *
     * Convert Markdown, JSON, or text content to professionally formatted PDF, DOCX, or HTML documents. Supports template components with variable interpolation for creating consistent legal documents like contracts, briefs, and reports.
     *
     * @param array{
     *   content: string,
     *   output_format: 'pdf'|'docx'|'html_preview',
     *   input_format?: 'md'|'json'|'text',
     *   options?: array{
     *     components?: list<array{
     *       content?: string, styles?: mixed, templateId?: string, variables?: mixed
     *     }>,
     *   },
     * }|V1CreateDocumentParams $params
     *
     * @throws APIException
     */
    public function createDocument(
        array|V1CreateDocumentParams $params,
        ?RequestOptions $requestOptions = null
    ): string {
        [$parsed, $options] = V1CreateDocumentParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'format/v1/document',
            headers: ['Accept' => 'application/pdf'],
            body: (object) $parsed,
            options: $options,
            convert: 'string',
        );
    }
}
