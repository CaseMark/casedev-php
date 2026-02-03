<?php

declare(strict_types=1);

namespace Casedev\Privilege\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Privilege\V1\V1DetectParams\Category;
use Casedev\Privilege\V1\V1DetectParams\Jurisdiction;

/**
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
 * @see Casedev\Services\Privilege\V1Service::detect()
 *
 * @phpstan-type V1DetectParamsShape = array{
 *   categories?: list<Category|value-of<Category>>|null,
 *   content?: string|null,
 *   documentID?: string|null,
 *   includeRationale?: bool|null,
 *   jurisdiction?: null|Jurisdiction|value-of<Jurisdiction>,
 *   model?: string|null,
 *   vaultID?: string|null,
 * }
 */
final class V1DetectParams implements BaseModel
{
    /** @use SdkModel<V1DetectParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Privilege categories to check. Defaults to all: attorney_client, work_product, common_interest, litigation_hold.
     *
     * @var list<value-of<Category>>|null $categories
     */
    #[Optional(list: Category::class)]
    public ?array $categories;

    /**
     * Text content to analyze (required if document_id not provided).
     */
    #[Optional]
    public ?string $content;

    /**
     * Vault object ID to analyze (required if content not provided).
     */
    #[Optional('document_id')]
    public ?string $documentID;

    /**
     * Include detailed rationale for each category.
     */
    #[Optional('include_rationale')]
    public ?bool $includeRationale;

    /**
     * Jurisdiction for privilege rules.
     *
     * @var value-of<Jurisdiction>|null $jurisdiction
     */
    #[Optional(enum: Jurisdiction::class)]
    public ?string $jurisdiction;

    /**
     * LLM model to use for analysis.
     */
    #[Optional]
    public ?string $model;

    /**
     * Vault ID (required when using document_id).
     */
    #[Optional('vault_id')]
    public ?string $vaultID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Category|value-of<Category>>|null $categories
     * @param Jurisdiction|value-of<Jurisdiction>|null $jurisdiction
     */
    public static function with(
        ?array $categories = null,
        ?string $content = null,
        ?string $documentID = null,
        ?bool $includeRationale = null,
        Jurisdiction|string|null $jurisdiction = null,
        ?string $model = null,
        ?string $vaultID = null,
    ): self {
        $self = new self;

        null !== $categories && $self['categories'] = $categories;
        null !== $content && $self['content'] = $content;
        null !== $documentID && $self['documentID'] = $documentID;
        null !== $includeRationale && $self['includeRationale'] = $includeRationale;
        null !== $jurisdiction && $self['jurisdiction'] = $jurisdiction;
        null !== $model && $self['model'] = $model;
        null !== $vaultID && $self['vaultID'] = $vaultID;

        return $self;
    }

    /**
     * Privilege categories to check. Defaults to all: attorney_client, work_product, common_interest, litigation_hold.
     *
     * @param list<Category|value-of<Category>> $categories
     */
    public function withCategories(array $categories): self
    {
        $self = clone $this;
        $self['categories'] = $categories;

        return $self;
    }

    /**
     * Text content to analyze (required if document_id not provided).
     */
    public function withContent(string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    /**
     * Vault object ID to analyze (required if content not provided).
     */
    public function withDocumentID(string $documentID): self
    {
        $self = clone $this;
        $self['documentID'] = $documentID;

        return $self;
    }

    /**
     * Include detailed rationale for each category.
     */
    public function withIncludeRationale(bool $includeRationale): self
    {
        $self = clone $this;
        $self['includeRationale'] = $includeRationale;

        return $self;
    }

    /**
     * Jurisdiction for privilege rules.
     *
     * @param Jurisdiction|value-of<Jurisdiction> $jurisdiction
     */
    public function withJurisdiction(Jurisdiction|string $jurisdiction): self
    {
        $self = clone $this;
        $self['jurisdiction'] = $jurisdiction;

        return $self;
    }

    /**
     * LLM model to use for analysis.
     */
    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * Vault ID (required when using document_id).
     */
    public function withVaultID(string $vaultID): self
    {
        $self = clone $this;
        $self['vaultID'] = $vaultID;

        return $self;
    }
}
