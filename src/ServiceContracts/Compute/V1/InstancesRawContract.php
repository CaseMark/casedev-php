<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Compute\V1;

use Casedev\Compute\V1\Instances\InstanceCreateParams;
use Casedev\Compute\V1\Instances\InstanceDeleteResponse;
use Casedev\Compute\V1\Instances\InstanceGetResponse;
use Casedev\Compute\V1\Instances\InstanceListResponse;
use Casedev\Compute\V1\Instances\InstanceNewResponse;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
