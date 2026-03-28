<?php

declare(strict_types=1);

namespace CaseDev\Services\Matters\V1;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Matters\V1\MatterParties\MatterPartyCreateParams;
use CaseDev\Matters\V1\MatterParties\MatterPartyCreateParams\Role;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Matters\V1\MatterPartiesRawContract;

/**
 * Matter-native legal workspaces and orchestration primitives.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class MatterPartiesRawService implements MatterPartiesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Attach a reusable party to a matter with a matter-specific role.
     *
     * @param array{
     *   partyID: string,
     *   role: value-of<Role>,
     *   customFields?: array<string,mixed>|null,
     *   isPrimary?: bool,
     *   metadata?: array<string,mixed>,
     *   notes?: string|null,
     *   setAsClient?: bool,
     * }|MatterPartyCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        string $id,
        array|MatterPartyCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MatterPartyCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['matters/v1/%1$s/parties', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List parties attached to a matter.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['matters/v1/%1$s/parties', $id],
            options: $requestOptions,
            convert: null,
        );
    }
}
