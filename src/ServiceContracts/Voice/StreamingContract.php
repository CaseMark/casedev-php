<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Voice;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Voice\Streaming\StreamingGetURLResponse;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
