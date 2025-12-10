<?php

declare(strict_types=1);

namespace Casedev\Services\Format;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Format\V1\V1CreateDocumentParams;
use Casedev\Format\V1\V1CreateDocumentParams\InputFormat;
use Casedev\Format\V1\V1CreateDocumentParams\OutputFormat;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Format\V1RawContract;

final class V1RawService implements V1RawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Convert Markdown, JSON, or text content to professionally formatted PDF, DOCX, or HTML documents. Supports template components with variable interpolation for creating consistent legal documents like contracts, briefs, and reports.
     *
     * @param array{
     *   content: string,
     *   outputFormat: 'pdf'|'docx'|'html_preview'|OutputFormat,
     *   inputFormat?: 'md'|'json'|'text'|InputFormat,
     *   options?: array{
     *     components?: list<array{
     *       content?: string, styles?: mixed, templateID?: string, variables?: mixed
     *     }>,
     *   },
     * }|V1CreateDocumentParams $params
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function createDocument(
        array|V1CreateDocumentParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
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
