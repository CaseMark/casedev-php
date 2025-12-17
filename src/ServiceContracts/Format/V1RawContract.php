<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Format;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Format\V1\V1CreateDocumentParams;
use Casedev\RequestOptions;

interface V1RawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|V1CreateDocumentParams $params
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function createDocument(
        array|V1CreateDocumentParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
