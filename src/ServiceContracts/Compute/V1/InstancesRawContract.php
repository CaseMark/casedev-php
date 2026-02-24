<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Compute\V1;

use CaseDev\Compute\V1\Instances\InstanceCreateParams;
use CaseDev\Compute\V1\Instances\InstanceDeleteResponse;
use CaseDev\Compute\V1\Instances\InstanceGetResponse;
use CaseDev\Compute\V1\Instances\InstanceListResponse;
use CaseDev\Compute\V1\Instances\InstanceNewResponse;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface InstancesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|InstanceCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InstanceNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|InstanceCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Instance ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InstanceGetResponse>
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
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InstanceListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Instance ID to terminate
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InstanceDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
