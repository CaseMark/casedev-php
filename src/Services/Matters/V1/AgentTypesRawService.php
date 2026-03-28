<?php

declare(strict_types=1);

namespace CaseDev\Services\Matters\V1;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Matters\V1\AgentTypes\AgentTypeCreateParams;
use CaseDev\Matters\V1\AgentTypes\AgentTypeListParams;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Matters\V1\AgentTypesRawContract;

/**
 * Matter-native legal workspaces and orchestration primitives.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class AgentTypesRawService implements AgentTypesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a reusable agent role for legal matter orchestration.
     *
     * @param array{
     *   instructions: string,
     *   name: string,
     *   description?: string,
     *   disabledTools?: list<string>,
     *   enabledTools?: list<string>,
     *   isActive?: bool,
     *   isDefault?: bool,
     *   metadata?: array<string,mixed>,
     *   model?: string,
     *   skillRefs?: list<string>,
     *   slug?: string,
     * }|AgentTypeCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|AgentTypeCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AgentTypeCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'matters/v1/agent-types',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List reusable agent roles for the authenticated organization.
     *
     * @param array{active?: bool}|AgentTypeListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|AgentTypeListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AgentTypeListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'matters/v1/agent-types',
            query: $parsed,
            options: $options,
            convert: null,
        );
    }
}
