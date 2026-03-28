<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Matters\V1;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Matters\V1\AgentTypes\AgentTypeCreateParams;
use CaseDev\Matters\V1\AgentTypes\AgentTypeListParams;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface AgentTypesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|AgentTypeCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|AgentTypeCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AgentTypeListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|AgentTypeListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
