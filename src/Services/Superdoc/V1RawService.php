<?php

declare(strict_types=1);

namespace CaseDev\Services\Superdoc;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Superdoc\V1RawContract;
use CaseDev\Superdoc\V1\V1AnnotateParams;
use CaseDev\Superdoc\V1\V1AnnotateParams\Document;
use CaseDev\Superdoc\V1\V1AnnotateParams\Field;
use CaseDev\Superdoc\V1\V1AnnotateParams\OutputFormat;
use CaseDev\Superdoc\V1\V1ConvertParams;
use CaseDev\Superdoc\V1\V1ConvertParams\From;
use CaseDev\Superdoc\V1\V1ConvertParams\To;

/**
 * @phpstan-import-type DocumentShape from \CaseDev\Superdoc\V1\V1AnnotateParams\Document
 * @phpstan-import-type FieldShape from \CaseDev\Superdoc\V1\V1AnnotateParams\Field
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
     * Populate fields inside a DOCX template using SuperDoc annotations. Supports text, images, dates, and numbers. Can target individual fields by ID or multiple fields by group.
     *
     * @param array{
     *   document: Document|DocumentShape,
     *   fields: list<Field|FieldShape>,
     *   outputFormat?: OutputFormat|value-of<OutputFormat>,
     * }|V1AnnotateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function annotate(
        array|V1AnnotateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1AnnotateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'superdoc/v1/annotate',
            headers: ['Accept' => 'application/pdf'],
            body: (object) $parsed,
            options: $options,
            convert: 'string',
        );
    }

    /**
     * @api
     *
     * Convert documents between formats using SuperDoc. Supports DOCX to PDF, Markdown to DOCX, and HTML to DOCX conversions.
     *
     * @param array{
     *   from: From|value-of<From>,
     *   documentBase64?: string,
     *   documentURL?: string,
     *   to?: To|value-of<To>,
     * }|V1ConvertParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function convert(
        array|V1ConvertParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1ConvertParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'superdoc/v1/convert',
            headers: [
                'Content-Type' => 'multipart/form-data', 'Accept' => 'application/pdf',
            ],
            body: (object) $parsed,
            options: $options,
            convert: 'string',
        );
    }
}
