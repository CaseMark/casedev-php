<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Format\V1;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Format\V1\Templates\TemplateCreateParams;
use CaseDev\Format\V1\Templates\TemplateGetResponse;
use CaseDev\Format\V1\Templates\TemplateListParams;
use CaseDev\Format\V1\Templates\TemplateListResponse;
use CaseDev\Format\V1\Templates\TemplateNewResponse;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface TemplatesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|TemplateCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TemplateNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|TemplateCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id The unique identifier of the format template
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TemplateGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|TemplateListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TemplateListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|TemplateListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
