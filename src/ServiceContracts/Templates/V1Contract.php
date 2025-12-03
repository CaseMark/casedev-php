<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Templates;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Templates\V1\V1ExecuteParams;
use Casedev\Templates\V1\V1ExecuteResponse;
use Casedev\Templates\V1\V1ListParams;
use Casedev\Templates\V1\V1SearchParams;

interface V1Contract
{
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
     * @param array<mixed>|V1ListParams $params
     *
     * @throws APIException
     */
    public function list(
        array|V1ListParams $params,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|V1ExecuteParams $params
     *
     * @throws APIException
     */
    public function execute(
        string $id,
        array|V1ExecuteParams $params,
        ?RequestOptions $requestOptions = null,
    ): V1ExecuteResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieveExecution(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|V1SearchParams $params
     *
     * @throws APIException
     */
    public function search(
        array|V1SearchParams $params,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
