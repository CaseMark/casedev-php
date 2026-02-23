<?php

declare(strict_types=1);

namespace Router\Search\V1;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Search\V1\V1AnswerResponse\Citation;

/**
 * @phpstan-import-type CitationShape from \Router\Search\V1\V1AnswerResponse\Citation
 *
 * @phpstan-type V1AnswerResponseShape = array{
 *   answer?: string|null,
 *   citations?: list<Citation|CitationShape>|null,
 *   model?: string|null,
 *   searchType?: string|null,
 * }
 */
final class V1AnswerResponse implements BaseModel
{
    /** @use SdkModel<V1AnswerResponseShape> */
    use SdkModel;

    /**
     * The generated answer with citations.
     */
    #[Optional]
    public ?string $answer;

    /**
     * Sources used to generate the answer.
     *
     * @var list<Citation>|null $citations
     */
    #[Optional(list: Citation::class)]
    public ?array $citations;

    /**
     * Model used for answer generation.
     */
    #[Optional]
    public ?string $model;

    /**
     * Type of search performed.
     */
    #[Optional]
    public ?string $searchType;

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
    public static function with(
        ?string $answer = null,
        ?array $citations = null,
        ?string $model = null,
        ?string $searchType = null,
    ): self {
        $self = new self;

        null !== $answer && $self['answer'] = $answer;
        null !== $citations && $self['citations'] = $citations;
        null !== $model && $self['model'] = $model;
        null !== $searchType && $self['searchType'] = $searchType;

        return $self;
    }

    /**
     * The generated answer with citations.
     */
    public function withAnswer(string $answer): self
    {
        $self = clone $this;
        $self['answer'] = $answer;

        return $self;
    }

    /**
     * Sources used to generate the answer.
     *
     * @param list<Citation|CitationShape> $citations
     */
    public function withCitations(array $citations): self
    {
        $self = clone $this;
        $self['citations'] = $citations;

        return $self;
    }

    /**
     * Model used for answer generation.
     */
    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * Type of search performed.
     */
    public function withSearchType(string $searchType): self
    {
        $self = clone $this;
        $self['searchType'] = $searchType;

        return $self;
    }
}
