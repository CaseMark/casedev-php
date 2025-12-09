<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Workflows;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Workflows\V1\V1CreateParams;
use Casedev\Workflows\V1\V1DeleteResponse;
use Casedev\Workflows\V1\V1DeployResponse;
use Casedev\Workflows\V1\V1ExecuteParams;
use Casedev\Workflows\V1\V1ExecuteResponse;
use Casedev\Workflows\V1\V1GetExecutionResponse;
use Casedev\Workflows\V1\V1GetResponse;
use Casedev\Workflows\V1\V1ListExecutionsParams;
use Casedev\Workflows\V1\V1ListExecutionsResponse;
use Casedev\Workflows\V1\V1ListParams;
use Casedev\Workflows\V1\V1ListResponse;
use Casedev\Workflows\V1\V1NewResponse;
use Casedev\Workflows\V1\V1UndeployResponse;
use Casedev\Workflows\V1\V1UpdateParams;
use Casedev\Workflows\V1\V1UpdateResponse;

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
    ): V1GetResponse;

    /**
     * @api
     *
     * @param array<mixed>|V1UpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|V1UpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): V1UpdateResponse;

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
    ): V1ListResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1DeleteResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function deploy(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1DeployResponse;

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
     * @param array<mixed>|V1ListExecutionsParams $params
     *
     * @throws APIException
     */
    public function listExecutions(
        string $id,
        array|V1ListExecutionsParams $params,
        ?RequestOptions $requestOptions = null,
    ): V1ListExecutionsResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieveExecution(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1GetExecutionResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function undeploy(
        string $id,
        ?RequestOptions $requestOptions = null
    ): V1UndeployResponse;
}
