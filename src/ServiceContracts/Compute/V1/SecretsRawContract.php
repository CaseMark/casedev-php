<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Compute\V1;

use CaseDev\Compute\V1\Secrets\SecretCreateParams;
use CaseDev\Compute\V1\Secrets\SecretDeleteGroupParams;
use CaseDev\Compute\V1\Secrets\SecretDeleteGroupResponse;
use CaseDev\Compute\V1\Secrets\SecretGetGroupResponse;
use CaseDev\Compute\V1\Secrets\SecretListParams;
use CaseDev\Compute\V1\Secrets\SecretListResponse;
use CaseDev\Compute\V1\Secrets\SecretNewResponse;
use CaseDev\Compute\V1\Secrets\SecretRetrieveGroupParams;
use CaseDev\Compute\V1\Secrets\SecretUpdateGroupParams;
use CaseDev\Compute\V1\Secrets\SecretUpdateGroupResponse;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
