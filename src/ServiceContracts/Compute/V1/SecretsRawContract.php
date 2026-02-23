<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Compute\V1;

use Router\Compute\V1\Secrets\SecretCreateParams;
use Router\Compute\V1\Secrets\SecretDeleteGroupParams;
use Router\Compute\V1\Secrets\SecretDeleteGroupResponse;
use Router\Compute\V1\Secrets\SecretGetGroupResponse;
use Router\Compute\V1\Secrets\SecretListParams;
use Router\Compute\V1\Secrets\SecretListResponse;
use Router\Compute\V1\Secrets\SecretNewResponse;
use Router\Compute\V1\Secrets\SecretRetrieveGroupParams;
use Router\Compute\V1\Secrets\SecretUpdateGroupParams;
use Router\Compute\V1\Secrets\SecretUpdateGroupResponse;
use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
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
     * @return BaseResponse<SecretListResponse>
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
     * @return BaseResponse<SecretDeleteGroupResponse>
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
     * @return BaseResponse<SecretGetGroupResponse>
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
     * @return BaseResponse<SecretUpdateGroupResponse>
     *
     * @throws APIException
     */
    public function updateGroup(
        string $group,
        array|SecretUpdateGroupParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
