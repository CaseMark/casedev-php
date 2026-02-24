<?php

declare(strict_types=1);

namespace CaseDev\Services\Format;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Format\V1\V1CreateDocumentParams;
use CaseDev\Format\V1\V1CreateDocumentParams\InputFormat;
use CaseDev\Format\V1\V1CreateDocumentParams\Options;
use CaseDev\Format\V1\V1CreateDocumentParams\OutputFormat;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Format\V1RawContract;

/**
 * @phpstan-import-type OptionsShape from \CaseDev\Format\V1\V1CreateDocumentParams\Options
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
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
     *   outputFormat: OutputFormat|value-of<OutputFormat>,
     *   inputFormat?: InputFormat|value-of<InputFormat>,
     *   options?: Options|OptionsShape,
     * }|V1CreateDocumentParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function createDocument(
        array|V1CreateDocumentParams $params,
        RequestOptions|array|null $requestOptions = null,
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
