<?php

declare(strict_types=1);

namespace Router\Legal\V1;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Legal\V1\V1GetCitationsResponse\Citation;

/**
 * @phpstan-import-type CitationShape from \Router\Legal\V1\V1GetCitationsResponse\Citation
 *
 * @phpstan-type V1GetCitationsResponseShape = array{
 *   citations?: list<Citation|CitationShape>|null
 * }
 */
final class V1GetCitationsResponse implements BaseModel
{
    /** @use SdkModel<V1GetCitationsResponseShape> */
    use SdkModel;

    /** @var list<Citation>|null $citations */
    #[Optional(list: Citation::class)]
    public ?array $citations;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Citation|CitationShape>|null $citations
     */
    public static function with(?array $citations = null): self
    {
        $self = new self;

        null !== $citations && $self['citations'] = $citations;

        return $self;
    }

    /**
     * @param list<Citation|CitationShape> $citations
     */
    public function withCitations(array $citations): self
    {
        $self = clone $this;
        $self['citations'] = $citations;

        return $self;
    }
}
