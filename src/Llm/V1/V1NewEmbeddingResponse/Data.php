<?php

declare(strict_types=1);

namespace CaseDev\Llm\V1\V1NewEmbeddingResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type DataShape = array{
 *   embedding?: list<float>|null, index?: int|null, object?: string|null
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /** @var list<float>|null $embedding */
    #[Optional(list: 'float')]
    public ?array $embedding;

    #[Optional]
    public ?int $index;

    #[Optional]
    public ?string $object;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<float>|null $embedding
     */
    public static function with(
        ?array $embedding = null,
        ?int $index = null,
        ?string $object = null
    ): self {
        $self = new self;

        null !== $embedding && $self['embedding'] = $embedding;
        null !== $index && $self['index'] = $index;
        null !== $object && $self['object'] = $object;

        return $self;
    }

    /**
     * @param list<float> $embedding
     */
    public function withEmbedding(array $embedding): self
    {
        $self = clone $this;
        $self['embedding'] = $embedding;

        return $self;
    }

    public function withIndex(int $index): self
    {
        $self = clone $this;
        $self['index'] = $index;

        return $self;
    }

    public function withObject(string $object): self
    {
        $self = clone $this;
        $self['object'] = $object;

        return $self;
    }
}
