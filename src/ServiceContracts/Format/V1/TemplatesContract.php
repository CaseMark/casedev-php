<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Format\V1;

use Casedev\Core\Exceptions\APIException;
use Casedev\Format\V1\Templates\TemplateCreateParams;
use Casedev\Format\V1\Templates\TemplateListParams;
use Casedev\Format\V1\Templates\TemplateNewResponse;
use Casedev\RequestOptions;

interface TemplatesContract
{
    /**
     * @api
     *
     * @param array<mixed>|TemplateCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|TemplateCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): TemplateNewResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|TemplateListParams $params
     *
     * @throws APIException
     */
    public function list(
        array|TemplateListParams $params,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
