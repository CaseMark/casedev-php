<?php

declare(strict_types=1);

namespace Casedev\Llm\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Llm\V1\V1ListModelsResponse\Data;

/**
 * @phpstan-import-type DataShape from \Casedev\Llm\V1\V1ListModelsResponse\Data
 *
 * @phpstan-type V1ListModelsResponseShape = array{
 *   data?: list<Data|DataShape>|null, object?: string|null
 * }
 */
final class V1ListModelsResponse implements BaseModel
{
    /** @use SdkModel<V1ListModelsResponseShape> */
    use SdkModel;

    /** @var list<Data>|null $data */
    #[Optional(list: Data::class)]
    public ?array $data;

    /**
     * Response object type, always 'list'.
     */
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
     * @param list<Data|DataShape>|null $data
     */
    public static function with(?array $data = null, ?string $object = null): self
    {
        $self = new self;

        null !== $data && $self['data'] = $data;
        null !== $object && $self['object'] = $object;

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

    /**
     * Response object type, always 'list'.
     */
    public function withObject(string $object): self
    {
        $self = clone $this;
        $self['object'] = $object;

        return $self;
    }
}
