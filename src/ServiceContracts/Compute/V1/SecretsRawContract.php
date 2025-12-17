<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Compute\V1;

use Casedev\Compute\V1\Secrets\SecretCreateParams;
use Casedev\Compute\V1\Secrets\SecretDeleteGroupParams;
use Casedev\Compute\V1\Secrets\SecretListParams;
use Casedev\Compute\V1\Secrets\SecretNewResponse;
use Casedev\Compute\V1\Secrets\SecretRetrieveGroupParams;
use Casedev\Compute\V1\Secrets\SecretUpdateGroupParams;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface SecretsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|SecretCreateParams $params
     *
     * @return BaseResponse<SecretNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|SecretCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|SecretListParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|SecretListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $group Name of the secret group
     * @param array<string,mixed>|SecretDeleteGroupParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function deleteGroup(
        string $group,
        array|SecretDeleteGroupParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $group Name of the secret group to list keys from
     * @param array<string,mixed>|SecretRetrieveGroupParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieveGroup(
        string $group,
        array|SecretRetrieveGroupParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $group Name of the secret group
     * @param array<string,mixed>|SecretUpdateGroupParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function updateGroup(
        string $group,
        array|SecretUpdateGroupParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
