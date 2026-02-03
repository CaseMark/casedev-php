<?php

declare(strict_types=1);

namespace Casedev\Legal\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Legal\V1\V1ListJurisdictionsResponse\Jurisdiction;

/**
 * @phpstan-import-type JurisdictionShape from \Casedev\Legal\V1\V1ListJurisdictionsResponse\Jurisdiction
 *
 * @phpstan-type V1ListJurisdictionsResponseShape = array{
 *   found?: int|null,
 *   hint?: string|null,
 *   jurisdictions?: list<Jurisdiction|JurisdictionShape>|null,
 *   query?: string|null,
 * }
 */
final class V1ListJurisdictionsResponse implements BaseModel
{
    /** @use SdkModel<V1ListJurisdictionsResponseShape> */
    use SdkModel;

    /**
     * Number of matching jurisdictions.
     */
    #[Optional]
    public ?int $found;

    /**
     * Usage guidance.
     */
    #[Optional]
    public ?string $hint;

    /** @var list<Jurisdiction>|null $jurisdictions */
    #[Optional(list: Jurisdiction::class)]
    public ?array $jurisdictions;

    /**
     * Original search query.
     */
    #[Optional]
    public ?string $query;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Jurisdiction|JurisdictionShape>|null $jurisdictions
     */
    public static function with(
        ?int $found = null,
        ?string $hint = null,
        ?array $jurisdictions = null,
        ?string $query = null,
    ): self {
        $self = new self;

        null !== $found && $self['found'] = $found;
        null !== $hint && $self['hint'] = $hint;
        null !== $jurisdictions && $self['jurisdictions'] = $jurisdictions;
        null !== $query && $self['query'] = $query;

        return $self;
    }

    /**
     * Number of matching jurisdictions.
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
     * @param list<Jurisdiction|JurisdictionShape> $jurisdictions
     */
    public function withJurisdictions(array $jurisdictions): self
    {
        $self = clone $this;
        $self['jurisdictions'] = $jurisdictions;

        return $self;
    }

    /**
     * Original search query.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }
}
