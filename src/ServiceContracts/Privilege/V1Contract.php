<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Privilege;

use Router\Core\Exceptions\APIException;
use Router\Privilege\V1\V1DetectParams\Category;
use Router\Privilege\V1\V1DetectParams\Jurisdiction;
use Router\Privilege\V1\V1DetectResponse;
use Router\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
interface V1Contract
{
    /**
     * @api
     *
     * @param list<Category|value-of<Category>> $categories Privilege categories to check. Defaults to all: attorney_client, work_product, common_interest, litigation_hold
     * @param string $content Text content to analyze (required if document_id not provided)
     * @param string $documentID Vault object ID to analyze (required if content not provided)
     * @param bool $includeRationale Include detailed rationale for each category
     * @param Jurisdiction|value-of<Jurisdiction> $jurisdiction Jurisdiction for privilege rules
     * @param string $model LLM model to use for analysis
     * @param string $vaultID Vault ID (required when using document_id)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function detect(
        ?array $categories = null,
        ?string $content = null,
        ?string $documentID = null,
        bool $includeRationale = true,
        Jurisdiction|string $jurisdiction = 'US-Federal',
        string $model = 'casemark/casemark-core-1',
        ?string $vaultID = null,
        RequestOptions|array|null $requestOptions = null,
    ): V1DetectResponse;
}
