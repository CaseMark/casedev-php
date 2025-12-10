<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Format\V1;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Format\V1\Templates\TemplateCreateParams;
use Casedev\Format\V1\Templates\TemplateListParams;
use Casedev\Format\V1\Templates\TemplateNewResponse;
use Casedev\RequestOptions;

interface TemplatesRawContract
{
    /**
     * @api
     *
     * @param array<mixed>|TemplateCreateParams $params
     *
     * @return BaseResponse<TemplateNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|TemplateCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id The unique identifier of the format template
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|TemplateListParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|TemplateListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
