<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Optional;
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
 *   limit?: int|null,
 *   offset?: int|null,
 *   visibility?: null|Visibility|value-of<Visibility>,
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
    #[Optional]
    public ?int $limit;

    /**
     * Offset for pagination.
     */
    #[Optional]
    public ?int $offset;

    /**
     * Filter by visibility.
     *
     * @var value-of<Visibility>|null $visibility
     */
    #[Optional(enum: Visibility::class)]
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
        $self = new self;

        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $visibility && $self['visibility'] = $visibility;

        return $self;
    }

    /**
     * Maximum number of results.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Offset for pagination.
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }

    /**
     * Filter by visibility.
     *
     * @param Visibility|value-of<Visibility> $visibility
     */
    public function withVisibility(Visibility|string $visibility): self
    {
        $self = clone $this;
        $self['visibility'] = $visibility;

        return $self;
    }
}
