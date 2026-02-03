<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Parties;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Payments\V1\Parties\PartyUpdateParams\Role;

/**
 * Update party details.
 *
 * @see Casedev\Services\Payments\V1\PartiesService::update()
 *
 * @phpstan-type PartyUpdateParamsShape = array{
 *   addressLine1?: string|null,
 *   addressLine2?: string|null,
 *   city?: string|null,
 *   country?: string|null,
 *   email?: string|null,
 *   isActive?: bool|null,
 *   metadata?: mixed,
 *   name?: string|null,
 *   notes?: string|null,
 *   phone?: string|null,
 *   postalCode?: string|null,
 *   role?: null|Role|value-of<Role>,
 *   state?: string|null,
 * }
 */
final class PartyUpdateParams implements BaseModel
{
    /** @use SdkModel<PartyUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional('address_line1')]
    public ?string $addressLine1;

    #[Optional('address_line2')]
    public ?string $addressLine2;

    #[Optional]
    public ?string $city;

    #[Optional]
    public ?string $country;

    #[Optional]
    public ?string $email;

    #[Optional('is_active')]
    public ?bool $isActive;

    #[Optional]
    public mixed $metadata;

    #[Optional]
    public ?string $name;

    #[Optional]
    public ?string $notes;

    #[Optional]
    public ?string $phone;

    #[Optional('postal_code')]
    public ?string $postalCode;

    /** @var value-of<Role>|null $role */
    #[Optional(enum: Role::class)]
    public ?string $role;

    #[Optional]
    public ?string $state;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Role|value-of<Role>|null $role
     */
    public static function with(
        ?string $addressLine1 = null,
        ?string $addressLine2 = null,
        ?string $city = null,
        ?string $country = null,
        ?string $email = null,
        ?bool $isActive = null,
        mixed $metadata = null,
        ?string $name = null,
        ?string $notes = null,
        ?string $phone = null,
        ?string $postalCode = null,
        Role|string|null $role = null,
        ?string $state = null,
    ): self {
        $self = new self;

        null !== $addressLine1 && $self['addressLine1'] = $addressLine1;
        null !== $addressLine2 && $self['addressLine2'] = $addressLine2;
        null !== $city && $self['city'] = $city;
        null !== $country && $self['country'] = $country;
        null !== $email && $self['email'] = $email;
        null !== $isActive && $self['isActive'] = $isActive;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $name && $self['name'] = $name;
        null !== $notes && $self['notes'] = $notes;
        null !== $phone && $self['phone'] = $phone;
        null !== $postalCode && $self['postalCode'] = $postalCode;
        null !== $role && $self['role'] = $role;
        null !== $state && $self['state'] = $state;

        return $self;
    }

    public function withAddressLine1(string $addressLine1): self
    {
        $self = clone $this;
        $self['addressLine1'] = $addressLine1;

        return $self;
    }

    public function withAddressLine2(string $addressLine2): self
    {
        $self = clone $this;
        $self['addressLine2'] = $addressLine2;

        return $self;
    }

    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    public function withIsActive(bool $isActive): self
    {
        $self = clone $this;
        $self['isActive'] = $isActive;

        return $self;
    }

    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withNotes(string $notes): self
    {
        $self = clone $this;
        $self['notes'] = $notes;

        return $self;
    }

    public function withPhone(string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }

    public function withPostalCode(string $postalCode): self
    {
        $self = clone $this;
        $self['postalCode'] = $postalCode;

        return $self;
    }

    /**
     * @param Role|value-of<Role> $role
     */
    public function withRole(Role|string $role): self
    {
        $self = clone $this;
        $self['role'] = $role;

        return $self;
    }

    public function withState(string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }
}
