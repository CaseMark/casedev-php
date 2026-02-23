<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Format;

use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\Format\V1\V1CreateDocumentParams;
use Router\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
interface V1RawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|V1CreateDocumentParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function createDocument(
        array|V1CreateDocumentParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
