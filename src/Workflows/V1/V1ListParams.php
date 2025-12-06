<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Workflows\V1\V1ListParams\Visibility;

/**
 * List all workflows for the authenticated organization.
 *
 * @see Casedev\Services\Workflows\V1Service::list()
 *
 * @phpstan-type V1ListParamsShape = array{
 *   limit?: int, offset?: int, visibility?: Visibility|value-of<Visibility>
 * }
 */
final class V1ListParams implements BaseModel
{
    /** @use SdkModel<V1ListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Maximum number of results.
     */
    #[Api(optional: true)]
    public ?int $limit;

    /**
     * Offset for pagination.
     */
    #[Api(optional: true)]
    public ?int $offset;

    /**
     * Filter by visibility.
     *
     * @var value-of<Visibility>|null $visibility
     */
    #[Api(enum: Visibility::class, optional: true)]
    public ?string $visibility;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Visibility|value-of<Visibility> $visibility
     */
    public static function with(
        ?int $limit = null,
        ?int $offset = null,
        Visibility|string|null $visibility = null
    ): self {
        $obj = new self;

        null !== $limit && $obj['limit'] = $limit;
        null !== $offset && $obj['offset'] = $offset;
        null !== $visibility && $obj['visibility'] = $visibility;

        return $obj;
    }

    /**
     * Maximum number of results.
     */
    public function withLimit(int $limit): self
    {
        $obj = clone $this;
        $obj['limit'] = $limit;

        return $obj;
    }

    /**
     * Offset for pagination.
     */
    public function withOffset(int $offset): self
    {
        $obj = clone $this;
        $obj['offset'] = $offset;

        return $obj;
    }

    /**
     * Filter by visibility.
     *
     * @param Visibility|value-of<Visibility> $visibility
     */
    public function withVisibility(Visibility|string $visibility): self
    {
        $obj = clone $this;
        $obj['visibility'] = $visibility;

        return $obj;
    }
}
