<?php

declare(strict_types=1);

namespace Casedev\Legal\V1\V1VerifyResponse\Citation;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type CandidateShape = array{
 *   court?: string|null,
 *   dateDecided?: string|null,
 *   name?: string|null,
 *   url?: string|null,
 * }
 */
final class Candidate implements BaseModel
{
    /** @use SdkModel<CandidateShape> */
    use SdkModel;

    #[Optional]
    public ?string $court;

    #[Optional]
    public ?string $dateDecided;

    #[Optional]
    public ?string $name;

    #[Optional]
    public ?string $url;

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
        ?string $court = null,
        ?string $dateDecided = null,
        ?string $name = null,
        ?string $url = null,
    ): self {
        $self = new self;

        null !== $court && $self['court'] = $court;
        null !== $dateDecided && $self['dateDecided'] = $dateDecided;
        null !== $name && $self['name'] = $name;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    public function withCourt(string $court): self
    {
        $self = clone $this;
        $self['court'] = $court;

        return $self;
    }

    public function withDateDecided(string $dateDecided): self
    {
        $self = clone $this;
        $self['dateDecided'] = $dateDecided;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
