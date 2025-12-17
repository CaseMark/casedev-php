<?php

declare(strict_types=1);

namespace Casedev\Templates\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Retrieve a paginated list of available workflows with optional filtering by category, subcategory, type, and publication status. Workflows are pre-built document processing pipelines optimized for legal use cases.
 *
 * @see Casedev\Services\Templates\V1Service::list()
 *
 * @phpstan-type V1ListParamsShape = array{
 *   category?: string|null,
 *   limit?: int|null,
 *   offset?: int|null,
 *   published?: bool|null,
 *   subCategory?: string|null,
 *   type?: string|null,
 * }
 */
final class V1ListParams implements BaseModel
{
    /** @use SdkModel<V1ListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter workflows by category (e.g., 'legal', 'compliance', 'contract').
     */
    #[Optional]
    public ?string $category;

    /**
     * Maximum number of workflows to return.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Number of workflows to skip for pagination.
     */
    #[Optional]
    public ?int $offset;

    /**
     * Include only published workflows.
     */
    #[Optional]
    public ?bool $published;

    /**
     * Filter workflows by subcategory (e.g., 'due-diligence', 'litigation', 'mergers').
     */
    #[Optional]
    public ?string $subCategory;

    /**
     * Filter workflows by type (e.g., 'document-review', 'contract-analysis', 'compliance-check').
     */
    #[Optional]
    public ?string $type;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $category = null,
        ?int $limit = null,
        ?int $offset = null,
        ?bool $published = null,
        ?string $subCategory = null,
        ?string $type = null,
    ): self {
        $self = new self;

        null !== $category && $self['category'] = $category;
        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $published && $self['published'] = $published;
        null !== $subCategory && $self['subCategory'] = $subCategory;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Filter workflows by category (e.g., 'legal', 'compliance', 'contract').
     */
    public function withCategory(string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * Maximum number of workflows to return.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Number of workflows to skip for pagination.
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }

    /**
     * Include only published workflows.
     */
    public function withPublished(bool $published): self
    {
        $self = clone $this;
        $self['published'] = $published;

        return $self;
    }

    /**
     * Filter workflows by subcategory (e.g., 'due-diligence', 'litigation', 'mergers').
     */
    public function withSubCategory(string $subCategory): self
    {
        $self = clone $this;
        $self['subCategory'] = $subCategory;

        return $self;
    }

    /**
     * Filter workflows by type (e.g., 'document-review', 'contract-analysis', 'compliance-check').
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
