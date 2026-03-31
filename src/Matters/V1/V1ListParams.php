<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * List matters for the authenticated organization.
 *
 * @see CaseDev\Services\Matters\V1Service::list()
 *
 * @phpstan-type V1ListParamsShape = array{
 *   matterType?: string|null,
 *   practiceArea?: string|null,
 *   query?: string|null,
 *   status?: string|null,
 * }
 */
final class V1ListParams implements BaseModel
{
    /** @use SdkModel<V1ListParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?string $matterType;

    #[Optional]
    public ?string $practiceArea;

    #[Optional]
    public ?string $query;

    #[Optional]
    public ?string $status;

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
        ?string $matterType = null,
        ?string $practiceArea = null,
        ?string $query = null,
        ?string $status = null,
    ): self {
        $self = new self;

        null !== $matterType && $self['matterType'] = $matterType;
        null !== $practiceArea && $self['practiceArea'] = $practiceArea;
        null !== $query && $self['query'] = $query;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    public function withMatterType(string $matterType): self
    {
        $self = clone $this;
        $self['matterType'] = $matterType;

        return $self;
    }

    public function withPracticeArea(string $practiceArea): self
    {
        $self = clone $this;
        $self['practiceArea'] = $practiceArea;

        return $self;
    }

    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
