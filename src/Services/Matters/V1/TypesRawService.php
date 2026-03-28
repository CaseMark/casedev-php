<?php

declare(strict_types=1);

namespace CaseDev\Services\Matters\V1;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Matters\V1\Types\TypeCreateParams;
use CaseDev\Matters\V1\Types\TypeCreateParams\OrchestrationMode;
use CaseDev\Matters\V1\Types\TypeListParams;
use CaseDev\Matters\V1\Types\TypeUpdateParams;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Matters\V1\TypesRawContract;

/**
 * Matter-native legal workspaces and orchestration primitives.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class TypesRawService implements TypesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a matter type with plain-English operating instructions and seeded work.
     *
     * @param array{
     *   name: string,
     *   defaultAgentTypeID?: string,
     *   defaultMetadata?: array<string,mixed>,
     *   defaultWorkItems?: list<array<string,mixed>>,
     *   description?: string,
     *   exitCriteria?: list<string>,
     *   instructions?: string,
     *   intakeRequirements?: list<string>,
     *   isActive?: bool,
     *   orchestrationMode?: OrchestrationMode|value-of<OrchestrationMode>,
     *   reviewAgentTypeID?: string,
     *   reviewCriteria?: list<string>,
     *   skillRefs?: list<string>,
     *   slug?: string,
     * }|TypeCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|TypeCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TypeCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'matters/v1/types',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get a single matter type.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
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
            path: ['matters/v1/types/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Update a matter type.
     *
     * @param array{
     *   defaultAgentTypeID?: string|null,
     *   defaultMetadata?: array<string,mixed>,
     *   defaultWorkItems?: list<array<string,mixed>>,
     *   description?: string|null,
     *   exitCriteria?: list<string>,
     *   instructions?: string|null,
     *   intakeRequirements?: list<string>,
     *   isActive?: bool,
     *   name?: string,
     *   orchestrationMode?: TypeUpdateParams\OrchestrationMode|value-of<TypeUpdateParams\OrchestrationMode>,
     *   reviewAgentTypeID?: string|null,
     *   reviewCriteria?: list<string>,
     *   skillRefs?: list<string>,
     *   slug?: string,
     * }|TypeUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|TypeUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TypeUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['matters/v1/types/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List matter types for the authenticated organization.
     *
     * @param array{active?: bool}|TypeListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|TypeListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TypeListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'matters/v1/types',
            query: $parsed,
            options: $options,
            convert: null,
        );
    }
}
