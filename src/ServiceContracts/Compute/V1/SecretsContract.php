<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Compute\V1;

use Casedev\Compute\V1\Secrets\SecretCreateParams;
use Casedev\Compute\V1\Secrets\SecretDeleteGroupParams;
use Casedev\Compute\V1\Secrets\SecretListParams;
use Casedev\Compute\V1\Secrets\SecretNewResponse;
use Casedev\Compute\V1\Secrets\SecretRetrieveGroupParams;
use Casedev\Compute\V1\Secrets\SecretUpdateGroupParams;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface SecretsContract
{
    /**
     * @api
     *
     * @param array<mixed>|SecretCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|SecretCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): SecretNewResponse;

    /**
     * @api
     *
     * @param array<mixed>|SecretListParams $params
     *
     * @throws APIException
     */
    public function list(
        array|SecretListParams $params,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|SecretDeleteGroupParams $params
     *
     * @throws APIException
     */
    public function deleteGroup(
        string $group,
        array|SecretDeleteGroupParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|SecretRetrieveGroupParams $params
     *
     * @throws APIException
     */
    public function retrieveGroup(
        string $group,
        array|SecretRetrieveGroupParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|SecretUpdateGroupParams $params
     *
     * @throws APIException
     */
    public function updateGroup(
        string $group,
        array|SecretUpdateGroupParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;
}
