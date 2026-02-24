<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Legal\V1\V1VerifyResponse\Citation;
use CaseDev\Legal\V1\V1VerifyResponse\Summary;

/**
 * @phpstan-import-type CitationShape from \CaseDev\Legal\V1\V1VerifyResponse\Citation
 * @phpstan-import-type SummaryShape from \CaseDev\Legal\V1\V1VerifyResponse\Summary
 *
 * @phpstan-type V1VerifyResponseShape = array{
 *   citations?: list<Citation|CitationShape>|null,
 *   summary?: null|Summary|SummaryShape,
 * }
 */
final class V1VerifyResponse implements BaseModel
{
    /** @use SdkModel<V1VerifyResponseShape> */
    use SdkModel;

    /** @var list<Citation>|null $citations */
    #[Optional(list: Citation::class)]
    public ?array $citations;

    #[Optional]
    public ?Summary $summary;

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
     * @param Summary|SummaryShape|null $summary
     */
    public static function with(
        ?array $citations = null,
        Summary|array|null $summary = null
    ): self {
        $self = new self;

        null !== $citations && $self['citations'] = $citations;
        null !== $summary && $self['summary'] = $summary;

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

    /**
     * @param Summary|SummaryShape $summary
     */
    public function withSummary(Summary|array $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }
}
