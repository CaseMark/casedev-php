<?php

declare(strict_types=1);

namespace Router\Vault\Objects\ObjectGetOcrWordsResponse\Page;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type WordShape = array{
 *   bbox?: list<float>|null,
 *   confidence?: float|null,
 *   text?: string|null,
 *   wordIndex?: int|null,
 * }
 */
final class Word implements BaseModel
{
    /** @use SdkModel<WordShape> */
    use SdkModel;

    /**
     * Bounding box [x0, y0, x1, y1] normalized to 0-1 range.
     *
     * @var list<float>|null $bbox
     */
    #[Optional(list: 'float')]
    public ?array $bbox;

    /**
     * OCR confidence score (0-1).
     */
    #[Optional(nullable: true)]
    public ?float $confidence;

    /**
     * The word text.
     */
    #[Optional]
    public ?string $text;

    /**
     * Global word index across the entire document (0-based).
     */
    #[Optional]
    public ?int $wordIndex;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<float>|null $bbox
     */
    public static function with(
        ?array $bbox = null,
        ?float $confidence = null,
        ?string $text = null,
        ?int $wordIndex = null,
    ): self {
        $self = new self;

        null !== $bbox && $self['bbox'] = $bbox;
        null !== $confidence && $self['confidence'] = $confidence;
        null !== $text && $self['text'] = $text;
        null !== $wordIndex && $self['wordIndex'] = $wordIndex;

        return $self;
    }

    /**
     * Bounding box [x0, y0, x1, y1] normalized to 0-1 range.
     *
     * @param list<float> $bbox
     */
    public function withBbox(array $bbox): self
    {
        $self = clone $this;
        $self['bbox'] = $bbox;

        return $self;
    }

    /**
     * OCR confidence score (0-1).
     */
    public function withConfidence(?float $confidence): self
    {
        $self = clone $this;
        $self['confidence'] = $confidence;

        return $self;
    }

    /**
     * The word text.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    /**
     * Global word index across the entire document (0-based).
     */
    public function withWordIndex(int $wordIndex): self
    {
        $self = clone $this;
        $self['wordIndex'] = $wordIndex;

        return $self;
    }
}
