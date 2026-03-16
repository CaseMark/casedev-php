<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Skills;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Skills\Custom\CustomListResponse;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface CustomContract
{
    /**
     * @api
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
    ): CustomListResponse;
}
