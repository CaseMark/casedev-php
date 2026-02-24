<?php

declare(strict_types=1);

namespace CaseDev\Privilege\V1\V1DetectResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type CategoryShape = array{
 *   confidence?: float|null,
 *   detected?: bool|null,
 *   indicators?: list<string>|null,
 *   rationale?: string|null,
 *   type?: string|null,
 * }
 */
final class Category implements BaseModel
{
    /** @use SdkModel<CategoryShape> */
    use SdkModel;

    /**
     * Confidence for this category (0-1).
     */
    #[Optional]
    public ?float $confidence;

    /**
     * Whether this privilege type was detected.
     */
    #[Optional]
    public ?bool $detected;

    /**
     * Specific phrases or patterns found.
     *
     * @var list<string>|null $indicators
     */
    #[Optional(list: 'string')]
    public ?array $indicators;

    /**
     * Explanation of detection result.
     */
    #[Optional]
    public ?string $rationale;

    /**
     * Privilege category.
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
     *
     * @param list<string>|null $indicators
     */
    public static function with(
        ?float $confidence = null,
        ?bool $detected = null,
        ?array $indicators = null,
        ?string $rationale = null,
        ?string $type = null,
    ): self {
        $self = new self;

        null !== $confidence && $self['confidence'] = $confidence;
        null !== $detected && $self['detected'] = $detected;
        null !== $indicators && $self['indicators'] = $indicators;
        null !== $rationale && $self['rationale'] = $rationale;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Confidence for this category (0-1).
     */
    public function withConfidence(float $confidence): self
    {
        $self = clone $this;
        $self['confidence'] = $confidence;

        return $self;
    }

    /**
     * Whether this privilege type was detected.
     */
    public function withDetected(bool $detected): self
    {
        $self = clone $this;
        $self['detected'] = $detected;

        return $self;
    }

    /**
     * Specific phrases or patterns found.
     *
     * @param list<string> $indicators
     */
    public function withIndicators(array $indicators): self
    {
        $self = clone $this;
        $self['indicators'] = $indicators;

        return $self;
    }

    /**
     * Explanation of detection result.
     */
    public function withRationale(string $rationale): self
    {
        $self = clone $this;
        $self['rationale'] = $rationale;

        return $self;
    }

    /**
     * Privilege category.
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
