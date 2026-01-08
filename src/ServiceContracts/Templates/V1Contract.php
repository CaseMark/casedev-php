<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Templates;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Templates\V1\V1ExecuteParams\Options;
use Casedev\Templates\V1\V1ExecuteResponse;

/**
 * @phpstan-import-type OptionsShape from \Casedev\Templates\V1\V1ExecuteParams\Options
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface V1Contract
{
    /**
     * @api
     *
     * @param string $id Workflow ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $category Filter workflows by category (e.g., 'legal', 'compliance', 'contract')
     * @param int $limit Maximum number of workflows to return
     * @param int $offset Number of workflows to skip for pagination
     * @param bool $published Include only published workflows
     * @param string $subCategory Filter workflows by subcategory (e.g., 'due-diligence', 'litigation', 'mergers')
     * @param string $type Filter workflows by type (e.g., 'document-review', 'contract-analysis', 'compliance-check')
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $category = null,
        int $limit = 50,
        int $offset = 0,
        bool $published = true,
        ?string $subCategory = null,
        ?string $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $id Unique identifier of the workflow to execute
     * @param mixed $input Input data for the workflow (structure varies by workflow type)
     * @param Options|OptionsShape $options
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function execute(
        string $id,
        mixed $input,
        Options|array|null $options = null,
        RequestOptions|array|null $requestOptions = null,
    ): V1ExecuteResponse;

    /**
     * @api
     *
     * @param string $id Unique identifier of the workflow execution
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveExecution(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $query Search query to find relevant workflows
     * @param string $category Optional category filter to narrow results
     * @param int $limit Maximum number of results to return (default: 10, max: 50)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function search(
        string $query,
        ?string $category = null,
        int $limit = 10,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
