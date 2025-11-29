<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Retrieve a paginated list of available workflows with optional filtering by category, subcategory, type, and publication status. Workflows are pre-built document processing pipelines optimized for legal use cases.
 *
 * @see Casedev\Services\Workflows\V1Service::list()
 *
 * @phpstan-type V1ListParamsShape = array{
 *   category?: string,
 *   limit?: int,
 *   offset?: int,
 *   published?: bool,
 *   sub_category?: string,
 *   type?: string,
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
    #[Api(optional: true)]
    public ?string $category;

    /**
     * Maximum number of workflows to return.
     */
    #[Api(optional: true)]
    public ?int $limit;

    /**
     * Number of workflows to skip for pagination.
     */
    #[Api(optional: true)]
    public ?int $offset;

    /**
     * Include only published workflows.
     */
    #[Api(optional: true)]
    public ?bool $published;

    /**
     * Filter workflows by subcategory (e.g., 'due-diligence', 'litigation', 'mergers').
     */
    #[Api(optional: true)]
    public ?string $sub_category;

    /**
     * Filter workflows by type (e.g., 'document-review', 'contract-analysis', 'compliance-check').
     */
    #[Api(optional: true)]
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
        ?string $sub_category = null,
        ?string $type = null,
    ): self {
        $obj = new self;

        null !== $category && $obj->category = $category;
        null !== $limit && $obj->limit = $limit;
        null !== $offset && $obj->offset = $offset;
        null !== $published && $obj->published = $published;
        null !== $sub_category && $obj->sub_category = $sub_category;
        null !== $type && $obj->type = $type;

        return $obj;
    }

    /**
     * Filter workflows by category (e.g., 'legal', 'compliance', 'contract').
     */
    public function withCategory(string $category): self
    {
        $obj = clone $this;
        $obj->category = $category;

        return $obj;
    }

    /**
     * Maximum number of workflows to return.
     */
    public function withLimit(int $limit): self
    {
        $obj = clone $this;
        $obj->limit = $limit;

        return $obj;
    }

    /**
     * Number of workflows to skip for pagination.
     */
    public function withOffset(int $offset): self
    {
        $obj = clone $this;
        $obj->offset = $offset;

        return $obj;
    }

    /**
     * Include only published workflows.
     */
    public function withPublished(bool $published): self
    {
        $obj = clone $this;
        $obj->published = $published;

        return $obj;
    }

    /**
     * Filter workflows by subcategory (e.g., 'due-diligence', 'litigation', 'mergers').
     */
    public function withSubCategory(string $subCategory): self
    {
        $obj = clone $this;
        $obj->sub_category = $subCategory;

        return $obj;
    }

    /**
     * Filter workflows by type (e.g., 'document-review', 'contract-analysis', 'compliance-check').
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }
}
