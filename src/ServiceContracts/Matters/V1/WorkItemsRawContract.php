<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Matters\V1;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Matters\V1\WorkItems\WorkItemCreateParams;
use CaseDev\Matters\V1\WorkItems\WorkItemDecideParams;
use CaseDev\Matters\V1\WorkItems\WorkItemListExecutionsParams;
use CaseDev\Matters\V1\WorkItems\WorkItemListParams;
use CaseDev\Matters\V1\WorkItems\WorkItemRetrieveParams;
use CaseDev\Matters\V1\WorkItems\WorkItemUpdateParams;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface WorkItemsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|WorkItemCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        string $id,
        array|WorkItemCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|WorkItemRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $workItemID,
        array|WorkItemRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $workItemID Path param
     * @param array<string,mixed>|WorkItemUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $workItemID,
        array|WorkItemUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|WorkItemListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        string $id,
        array|WorkItemListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $workItemID Path param
     * @param array<string,mixed>|WorkItemDecideParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function decide(
        string $workItemID,
        array|WorkItemDecideParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|WorkItemListExecutionsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function listExecutions(
        string $workItemID,
        array|WorkItemListExecutionsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
