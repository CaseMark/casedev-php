<?php

declare(strict_types=1);

namespace CaseDev\Services\Skills;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Skills\CustomContract;
use CaseDev\Skills\Custom\CustomListResponse;

/**
 * Search and read legal AI skills for agents.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class CustomService implements CustomContract
{
    /**
     * @api
     */
    public CustomRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CustomRawService($client);
    }

    /**
     * @api
     *
     * List all custom skills for the authenticated organization. Supports cursor-based pagination.
     *
     * @param string $cursor Cursor for pagination (skill ID from previous page)
     * @param int $limit Maximum number of results (1-100)
     * @param string $tag Filter by tag
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        int $limit = 50,
        ?string $tag = null,
        RequestOptions|array|null $requestOptions = null,
    ): CustomListResponse {
        $params = Util::removeNulls(
            ['cursor' => $cursor, 'limit' => $limit, 'tag' => $tag]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
