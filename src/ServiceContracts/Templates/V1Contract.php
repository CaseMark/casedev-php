<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Templates;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Templates\V1\V1ExecuteParams\Options\Format;
use Casedev\Templates\V1\V1ExecuteResponse;

interface V1Contract
{
    /**
     * @api
     *
     * @param string $id Workflow ID
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
     * @param string $category Filter workflows by category (e.g., 'legal', 'compliance', 'contract')
     * @param int $limit Maximum number of workflows to return
     * @param int $offset Number of workflows to skip for pagination
     * @param bool $published Include only published workflows
     * @param string $subCategory Filter workflows by subcategory (e.g., 'due-diligence', 'litigation', 'mergers')
     * @param string $type Filter workflows by type (e.g., 'document-review', 'contract-analysis', 'compliance-check')
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
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $id Unique identifier of the workflow to execute
     * @param mixed $input Input data for the workflow (structure varies by workflow type)
     * @param array{format?: 'json'|'text'|Format, model?: string} $options
     *
     * @throws APIException
     */
    public function execute(
        string $id,
        mixed $input,
        ?array $options = null,
        ?RequestOptions $requestOptions = null,
    ): V1ExecuteResponse;

    /**
     * @api
     *
     * @param string $id Unique identifier of the workflow execution
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
     * @param string $query Search query to find relevant workflows
     * @param string $category Optional category filter to narrow results
     * @param int $limit Maximum number of results to return (default: 10, max: 50)
     *
     * @throws APIException
     */
    public function search(
        string $query,
        ?string $category = null,
        int $limit = 10,
        ?RequestOptions $requestOptions = null,
    ): mixed;
}
