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

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface SecretsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|SecretCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SecretNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|SecretCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|SecretListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|SecretListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $group Name of the secret group
     * @param array<string,mixed>|SecretDeleteGroupParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function deleteGroup(
        string $group,
        array|SecretDeleteGroupParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $group Name of the secret group to list keys from
     * @param array<string,mixed>|SecretRetrieveGroupParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieveGroup(
        string $group,
        array|SecretRetrieveGroupParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $group Name of the secret group
     * @param array<string,mixed>|SecretUpdateGroupParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function updateGroup(
        string $group,
        array|SecretUpdateGroupParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
