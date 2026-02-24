<?php

declare(strict_types=1);

namespace CaseDev\Llm\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Llm\V1\V1NewEmbeddingResponse\Data;
use CaseDev\Llm\V1\V1NewEmbeddingResponse\Usage;

/**
 * @phpstan-import-type DataShape from \CaseDev\Llm\V1\V1NewEmbeddingResponse\Data
 * @phpstan-import-type UsageShape from \CaseDev\Llm\V1\V1NewEmbeddingResponse\Usage
 *
 * @phpstan-type V1NewEmbeddingResponseShape = array{
 *   data?: list<Data|DataShape>|null,
 *   model?: string|null,
 *   object?: string|null,
 *   usage?: null|Usage|UsageShape,
 * }
 */
final class V1NewEmbeddingResponse implements BaseModel
{
    /** @use SdkModel<V1NewEmbeddingResponseShape> */
    use SdkModel;

    /** @var list<Data>|null $data */
    #[Optional(list: Data::class)]
    public ?array $data;

    #[Optional]
    public ?string $model;

    #[Optional]
    public ?string $object;

    #[Optional]
    public ?Usage $usage;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Data|DataShape>|null $data
     * @param Usage|UsageShape|null $usage
     */
    public static function with(
        ?array $data = null,
        ?string $model = null,
        ?string $object = null,
        Usage|array|null $usage = null,
    ): self {
        $self = new self;

        null !== $data && $self['data'] = $data;
        null !== $model && $self['model'] = $model;
        null !== $object && $self['object'] = $object;
        null !== $usage && $self['usage'] = $usage;

        return $self;
    }

    /**
     * @param list<Data|DataShape> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    public function withObject(string $object): self
    {
        $self = clone $this;
        $self['object'] = $object;

        return $self;
    }

    /**
     * @param Usage|UsageShape $usage
     */
    public function withUsage(Usage|array $usage): self
    {
        $self = clone $this;
        $self['usage'] = $usage;

        return $self;
    }
}
