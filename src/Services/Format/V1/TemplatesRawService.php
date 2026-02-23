<?php

declare(strict_types=1);

namespace Router\Services\Format\V1;

use Router\Client;
use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\Format\V1\Templates\TemplateCreateParams;
use Router\Format\V1\Templates\TemplateCreateParams\Type;
use Router\Format\V1\Templates\TemplateGetResponse;
use Router\Format\V1\Templates\TemplateListParams;
use Router\Format\V1\Templates\TemplateListResponse;
use Router\Format\V1\Templates\TemplateNewResponse;
use Router\RequestOptions;
use Router\ServiceContracts\Format\V1\TemplatesRawContract;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
final class TemplatesRawService implements TemplatesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a new format template for document formatting. Templates support variables using `{{variable}}` syntax and can be used for captions, signatures, letterheads, certificates, footers, or custom formatting needs.
     *
     * @param array{
     *   content: string,
     *   name: string,
     *   type: Type|value-of<Type>,
     *   description?: string,
     *   styles?: mixed,
     *   tags?: list<string>,
     *   variables?: list<string>,
     * }|TemplateCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TemplateNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|TemplateCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TemplateCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'format/v1/templates',
            body: (object) $parsed,
            options: $options,
            convert: TemplateNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a specific document format template by ID. Format templates define how documents should be structured and formatted for specific legal use cases such as contracts, briefs, or pleadings.
     *
     * @param string $id The unique identifier of the format template
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TemplateGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['format/v1/templates/%1$s', $id],
            options: $requestOptions,
            convert: TemplateGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve all format templates for the organization. Templates define reusable document formatting patterns with customizable variables for consistent legal document generation.
     *
     * Filter by type to get specific template categories like contracts, pleadings, or correspondence.
     *
     * @param array{type?: string}|TemplateListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TemplateListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|TemplateListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TemplateListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'format/v1/templates',
            query: $parsed,
            options: $options,
            convert: TemplateListResponse::class,
        );
    }
}
