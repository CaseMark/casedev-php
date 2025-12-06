<?php

declare(strict_types=1);

namespace Casedev\Search\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkResponse;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Core\Conversion\Contracts\ResponseConverter;
use Casedev\Search\V1\V1AnswerResponse\Citation;

/**
 * @phpstan-type V1AnswerResponseShape = array{
 *   answer?: string|null,
 *   citations?: list<Citation>|null,
 *   model?: string|null,
 *   searchType?: string|null,
 * }
 */
final class V1AnswerResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<V1AnswerResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * The generated answer with citations.
     */
    #[Api(optional: true)]
    public ?string $answer;

    /**
     * Sources used to generate the answer.
     *
     * @var list<Citation>|null $citations
     */
    #[Api(list: Citation::class, optional: true)]
    public ?array $citations;

    /**
     * Model used for answer generation.
     */
    #[Api(optional: true)]
    public ?string $model;

    /**
     * Type of search performed.
     */
    #[Api(optional: true)]
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
     * @param list<Citation|array{
     *   id?: string|null,
     *   publishedDate?: string|null,
     *   text?: string|null,
     *   title?: string|null,
     *   url?: string|null,
     * }> $citations
     */
    public static function with(
        ?string $answer = null,
        ?array $citations = null,
        ?string $model = null,
        ?string $searchType = null,
    ): self {
        $obj = new self;

        null !== $answer && $obj['answer'] = $answer;
        null !== $citations && $obj['citations'] = $citations;
        null !== $model && $obj['model'] = $model;
        null !== $searchType && $obj['searchType'] = $searchType;

        return $obj;
    }

    /**
     * The generated answer with citations.
     */
    public function withAnswer(string $answer): self
    {
        $obj = clone $this;
        $obj['answer'] = $answer;

        return $obj;
    }

    /**
     * Sources used to generate the answer.
     *
     * @param list<Citation|array{
     *   id?: string|null,
     *   publishedDate?: string|null,
     *   text?: string|null,
     *   title?: string|null,
     *   url?: string|null,
     * }> $citations
     */
    public function withCitations(array $citations): self
    {
        $obj = clone $this;
        $obj['citations'] = $citations;

        return $obj;
    }

    /**
     * Model used for answer generation.
     */
    public function withModel(string $model): self
    {
        $obj = clone $this;
        $obj['model'] = $model;

        return $obj;
    }

    /**
     * Type of search performed.
     */
    public function withSearchType(string $searchType): self
    {
        $obj = clone $this;
        $obj['searchType'] = $searchType;

        return $obj;
    }
}
