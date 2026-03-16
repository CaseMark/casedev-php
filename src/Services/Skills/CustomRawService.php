<?php

declare(strict_types=1);

namespace CaseDev\Services\Skills;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Skills\CustomRawContract;
use CaseDev\Skills\Custom\CustomListParams;
use CaseDev\Skills\Custom\CustomListResponse;

/**
 * Search and read legal AI skills for agents.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class CustomRawService implements CustomRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * List all custom skills for the authenticated organization. Supports cursor-based pagination.
     *
     * @param array{
     *   cursor?: string, limit?: int, tag?: string
     * }|CustomListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CustomListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|CustomListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CustomListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'skills/custom',
            query: $parsed,
            options: $options,
            convert: CustomListResponse::class,
        );
    }
}
