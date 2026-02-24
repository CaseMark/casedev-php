<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Format;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Format\V1\V1CreateDocumentParams;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
