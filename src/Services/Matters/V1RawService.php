<?php

declare(strict_types=1);

namespace CaseDev\Services\Matters;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\Matters\V1\V1CreateParams;
use CaseDev\Matters\V1\V1CreateParams\Status;
use CaseDev\Matters\V1\V1CreateParams\Vault;
use CaseDev\Matters\V1\V1ListParams;
use CaseDev\Matters\V1\V1UpdateParams;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Matters\V1RawContract;

/**
 * Matter-native legal workspaces and orchestration primitives.
 *
 * @phpstan-import-type VaultShape from \CaseDev\Matters\V1\V1CreateParams\Vault
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
     * Create a new legal matter and provision its primary vault.
     *
     * @param array{
     *   title: string,
     *   billing?: array<string,mixed>,
     *   clientName?: string,
     *   clientPartyID?: string|null,
     *   customFields?: array<string,mixed>,
     *   description?: string,
     *   displayID?: string,
     *   importantDates?: array<string,mixed>,
     *   jurisdiction?: array<string,mixed>,
     *   matterType?: string,
     *   metadata?: array<string,mixed>,
     *   practiceArea?: string,
     *   responsibleAttorneyID?: string,
     *   status?: Status|value-of<Status>,
     *   subtype?: string,
     *   vault?: Vault|VaultShape,
     * }|V1CreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|V1CreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1CreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'matters/v1',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get a single matter by ID.
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
            path: ['matters/v1/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Update mutable matter fields.
     *
     * @param array{
     *   archivedAt?: \DateTimeInterface|null,
     *   billing?: array<string,mixed>,
     *   clientName?: string,
     *   clientPartyID?: string|null,
     *   customFields?: array<string,mixed>,
     *   description?: string,
     *   displayID?: string,
     *   importantDates?: array<string,mixed>,
     *   jurisdiction?: array<string,mixed>,
     *   matterType?: string,
     *   metadata?: array<string,mixed>,
     *   practiceArea?: string,
     *   responsibleAttorneyID?: string,
     *   status?: V1UpdateParams\Status|value-of<V1UpdateParams\Status>,
     *   subtype?: string,
     *   title?: string,
     * }|V1UpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|V1UpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1UpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['matters/v1/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List matters for the authenticated organization.
     *
     * @param array{
     *   matterType?: string, practiceArea?: string, query?: string, status?: string
     * }|V1ListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|V1ListParams $params,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = V1ListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'matters/v1',
            query: Util::array_transform_keys(
                $parsed,
                ['matterType' => 'matter_type', 'practiceArea' => 'practice_area'],
            ),
            options: $options,
            convert: null,
        );
    }
}
