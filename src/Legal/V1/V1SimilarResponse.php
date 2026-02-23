<?php

declare(strict_types=1);

namespace Router\Legal\V1;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Legal\V1\V1SimilarResponse\SimilarSource;

/**
 * @phpstan-import-type SimilarSourceShape from \Router\Legal\V1\V1SimilarResponse\SimilarSource
 *
 * @phpstan-type V1SimilarResponseShape = array{
 *   found?: int|null,
 *   hint?: string|null,
 *   jurisdiction?: string|null,
 *   similarSources?: list<SimilarSource|SimilarSourceShape>|null,
 *   sourceURL?: string|null,
 * }
 */
final class V1SimilarResponse implements BaseModel
{
    /** @use SdkModel<V1SimilarResponseShape> */
    use SdkModel;

    /**
     * Number of similar sources found.
     */
    #[Optional]
    public ?int $found;

    /**
     * Usage guidance.
     */
    #[Optional]
    public ?string $hint;

    /**
     * Jurisdiction filter applied.
     */
    #[Optional]
    public ?string $jurisdiction;

    /** @var list<SimilarSource>|null $similarSources */
    #[Optional(list: SimilarSource::class)]
    public ?array $similarSources;

    /**
     * Original source URL.
     */
    #[Optional('sourceUrl')]
    public ?string $sourceURL;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<SimilarSource|SimilarSourceShape>|null $similarSources
     */
    public static function with(
        ?int $found = null,
        ?string $hint = null,
        ?string $jurisdiction = null,
        ?array $similarSources = null,
        ?string $sourceURL = null,
    ): self {
        $self = new self;

        null !== $found && $self['found'] = $found;
        null !== $hint && $self['hint'] = $hint;
        null !== $jurisdiction && $self['jurisdiction'] = $jurisdiction;
        null !== $similarSources && $self['similarSources'] = $similarSources;
        null !== $sourceURL && $self['sourceURL'] = $sourceURL;

        return $self;
    }

    /**
     * Number of similar sources found.
     */
    public function withFound(int $found): self
    {
        $self = clone $this;
        $self['found'] = $found;

        return $self;
    }

    /**
     * Usage guidance.
     */
    public function withHint(string $hint): self
    {
        $self = clone $this;
        $self['hint'] = $hint;

        return $self;
    }

    /**
     * Jurisdiction filter applied.
     */
    public function withJurisdiction(string $jurisdiction): self
    {
        $self = clone $this;
        $self['jurisdiction'] = $jurisdiction;

        return $self;
    }

    /**
     * @param list<SimilarSource|SimilarSourceShape> $similarSources
     */
    public function withSimilarSources(array $similarSources): self
    {
        $self = clone $this;
        $self['similarSources'] = $similarSources;

        return $self;
    }

    /**
     * Original source URL.
     */
    public function withSourceURL(string $sourceURL): self
    {
        $self = clone $this;
        $self['sourceURL'] = $sourceURL;

        return $self;
    }
}
