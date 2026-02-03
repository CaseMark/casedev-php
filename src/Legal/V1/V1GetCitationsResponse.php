<?php

declare(strict_types=1);

namespace Casedev\Legal\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Legal\V1\V1GetCitationsResponse\Citation;

/**
 * @phpstan-import-type CitationShape from \Casedev\Legal\V1\V1GetCitationsResponse\Citation
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
