<?php

declare(strict_types=1);

namespace Casedev\Vault\Objects\ObjectGetOcrWordsResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Vault\Objects\ObjectGetOcrWordsResponse\Page\Word;

/**
 * @phpstan-import-type WordShape from \Casedev\Vault\Objects\ObjectGetOcrWordsResponse\Page\Word
 *
 * @phpstan-type PageShape = array{
 *   page?: int|null, words?: list<Word|WordShape>|null
 * }
 */
final class Page implements BaseModel
{
    /** @use SdkModel<PageShape> */
    use SdkModel;

    /**
     * Page number (1-indexed).
     */
    #[Optional]
    public ?int $page;

    /** @var list<Word>|null $words */
    #[Optional(list: Word::class)]
    public ?array $words;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Word|WordShape>|null $words
     */
    public static function with(?int $page = null, ?array $words = null): self
    {
        $self = new self;

        null !== $page && $self['page'] = $page;
        null !== $words && $self['words'] = $words;

        return $self;
    }

    /**
     * Page number (1-indexed).
     */
    public function withPage(int $page): self
    {
        $self = clone $this;
        $self['page'] = $page;

        return $self;
    }

    /**
     * @param list<Word|WordShape> $words
     */
    public function withWords(array $words): self
    {
        $self = clone $this;
        $self['words'] = $words;

        return $self;
    }
}
