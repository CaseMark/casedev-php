<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Superdoc;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Superdoc\V1\V1AnnotateParams;
use Casedev\Superdoc\V1\V1ConvertParams;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface V1RawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|V1AnnotateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function annotate(
        array|V1AnnotateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1ConvertParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function convert(
        array|V1ConvertParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
