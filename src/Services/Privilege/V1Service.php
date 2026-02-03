<?php

declare(strict_types=1);

namespace Casedev\Services\Privilege;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\Privilege\V1\V1DetectParams\Category;
use Casedev\Privilege\V1\V1DetectParams\Jurisdiction;
use Casedev\Privilege\V1\V1DetectResponse;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Privilege\V1Contract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public V1RawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
    }

    /**
     * @api
     *
     * Analyzes text or vault documents for legal privilege. Detects attorney-client privilege, work product doctrine, common interest privilege, and litigation hold materials.
     *
     * Returns structured privilege flags with confidence scores and policy-friendly rationale suitable for discovery workflows and privilege logs.
     *
     * **Size Limit:** Maximum 200,000 characters (larger documents rejected).
     *
     * **Permissions:** Requires `chat` permission. When using `document_id`, also requires `vault` permission.
     *
     * **Note:** When analyzing vault documents, results are automatically stored in the document's `privilege_analysis` metadata field.
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
    ): V1DetectResponse {
        $params = Util::removeNulls(
            [
                'categories' => $categories,
                'content' => $content,
                'documentID' => $documentID,
                'includeRationale' => $includeRationale,
                'jurisdiction' => $jurisdiction,
                'model' => $model,
                'vaultID' => $vaultID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->detect(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
