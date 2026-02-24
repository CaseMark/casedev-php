<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1VerifyResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type SummaryShape = array{
 *   multipleMatches?: int|null,
 *   notFound?: int|null,
 *   total?: int|null,
 *   verified?: int|null,
 * }
 */
final class Summary implements BaseModel
{
    /** @use SdkModel<SummaryShape> */
    use SdkModel;

    /**
     * Citations with multiple possible matches.
     */
    #[Optional]
    public ?int $multipleMatches;

    /**
     * Citations not found in database.
     */
    #[Optional]
    public ?int $notFound;

    /**
     * Total citations found.
     */
    #[Optional]
    public ?int $total;

    /**
     * Citations verified against real cases.
     */
    #[Optional]
    public ?int $verified;

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
        ?int $multipleMatches = null,
        ?int $notFound = null,
        ?int $total = null,
        ?int $verified = null,
    ): self {
        $self = new self;

        null !== $multipleMatches && $self['multipleMatches'] = $multipleMatches;
        null !== $notFound && $self['notFound'] = $notFound;
        null !== $total && $self['total'] = $total;
        null !== $verified && $self['verified'] = $verified;

        return $self;
    }

    /**
     * Citations with multiple possible matches.
     */
    public function withMultipleMatches(int $multipleMatches): self
    {
        $self = clone $this;
        $self['multipleMatches'] = $multipleMatches;

        return $self;
    }

    /**
     * Citations not found in database.
     */
    public function withNotFound(int $notFound): self
    {
        $self = clone $this;
        $self['notFound'] = $notFound;

        return $self;
    }

    /**
     * Total citations found.
     */
    public function withTotal(int $total): self
    {
        $self = clone $this;
        $self['total'] = $total;

        return $self;
    }

    /**
     * Citations verified against real cases.
     */
    public function withVerified(int $verified): self
    {
        $self = clone $this;
        $self['verified'] = $verified;

        return $self;
    }
}
