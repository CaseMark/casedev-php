<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Voice;

use Router\Core\Exceptions\APIException;
use Router\RequestOptions;
use Router\Voice\Streaming\StreamingGetURLResponse;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
interface StreamingContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getURL(
        RequestOptions|array|null $requestOptions = null
    ): StreamingGetURLResponse;
}
