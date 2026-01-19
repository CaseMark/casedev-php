<?php

declare(strict_types=1);

namespace Casedev\Llm\V1\V1ListModelsResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Llm\V1\V1ListModelsResponse\Data\Pricing;

/**
 * @phpstan-import-type PricingShape from \Casedev\Llm\V1\V1ListModelsResponse\Data\Pricing
 *
 * @phpstan-type DataShape = array{
 *   id?: string|null,
 *   created?: int|null,
 *   object?: string|null,
 *   ownedBy?: string|null,
 *   pricing?: null|Pricing|PricingShape,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Unique model identifier.
     */
    #[Optional]
    public ?string $id;

    /**
     * Unix timestamp of model creation.
     */
    #[Optional]
    public ?int $created;

    /**
     * Object type, always 'model'.
     */
    #[Optional]
    public ?string $object;

    /**
     * Model provider (openai, anthropic, google, casemark, etc.).
     */
    #[Optional('owned_by')]
    public ?string $ownedBy;

    #[Optional]
    public ?Pricing $pricing;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Pricing|PricingShape|null $pricing
     */
    public static function with(
        ?string $id = null,
        ?int $created = null,
        ?string $object = null,
        ?string $ownedBy = null,
        Pricing|array|null $pricing = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $created && $self['created'] = $created;
        null !== $object && $self['object'] = $object;
        null !== $ownedBy && $self['ownedBy'] = $ownedBy;
        null !== $pricing && $self['pricing'] = $pricing;

        return $self;
    }

    /**
     * Unique model identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Unix timestamp of model creation.
     */
    public function withCreated(int $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    /**
     * Object type, always 'model'.
     */
    public function withObject(string $object): self
    {
        $self = clone $this;
        $self['object'] = $object;

        return $self;
    }

    /**
     * Model provider (openai, anthropic, google, casemark, etc.).
     */
    public function withOwnedBy(string $ownedBy): self
    {
        $self = clone $this;
        $self['ownedBy'] = $ownedBy;

        return $self;
    }

    /**
     * @param Pricing|PricingShape $pricing
     */
    public function withPricing(Pricing|array $pricing): self
    {
        $self = clone $this;
        $self['pricing'] = $pricing;

        return $self;
    }
}
