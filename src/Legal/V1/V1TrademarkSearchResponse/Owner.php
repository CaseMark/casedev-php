<?php

declare(strict_types=1);

namespace Router\Legal\V1\V1TrademarkSearchResponse;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * Current owner/applicant information.
 *
 * @phpstan-type OwnerShape = array{
 *   address?: string|null, entityType?: string|null, name?: string|null
 * }
 */
final class Owner implements BaseModel
{
    /** @use SdkModel<OwnerShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?string $address;

    #[Optional(nullable: true)]
    public ?string $entityType;

    #[Optional(nullable: true)]
    public ?string $name;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $address = null,
        ?string $entityType = null,
        ?string $name = null
    ): self {
        $self = new self;

        null !== $address && $self['address'] = $address;
        null !== $entityType && $self['entityType'] = $entityType;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    public function withAddress(?string $address): self
    {
        $self = clone $this;
        $self['address'] = $address;

        return $self;
    }

    public function withEntityType(?string $entityType): self
    {
        $self = clone $this;
        $self['entityType'] = $entityType;

        return $self;
    }

    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
