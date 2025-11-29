<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Webhooks;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Webhooks\V1\V1CreateParams;
use Casedev\Webhooks\V1\V1NewResponse;

interface V1Contract
{
    /**
     * @api
     *
     * @param array<mixed>|V1CreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|V1CreateParams $params,
        ?RequestOptions $requestOptions = null
    ): V1NewResponse;

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
     * @throws APIException
     */
    public function list(
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
