<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Parties;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Payments\V1\Parties\PartyCreateParams\Role;
use Casedev\Payments\V1\Parties\PartyCreateParams\Type;

/**
 * Create a new payment party (client, vendor, counsel, etc.).
 *
 * @see Casedev\Services\Payments\V1\PartiesService::create()
 *
 * @phpstan-type PartyCreateParamsShape = array{
 *   name: string,
 *   type: Type|value-of<Type>,
 *   addressLine1?: string|null,
 *   city?: string|null,
 *   country?: string|null,
 *   email?: string|null,
 *   metadata?: mixed,
 *   phone?: string|null,
 *   postalCode?: string|null,
 *   role?: null|Role|value-of<Role>,
 *   state?: string|null,
 * }
 */
final class PartyCreateParams implements BaseModel
{
    /** @use SdkModel<PartyCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $name;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Optional('address_line1')]
    public ?string $addressLine1;

    #[Optional]
    public ?string $city;

    #[Optional]
    public ?string $country;

    #[Optional]
    public ?string $email;

    #[Optional]
    public mixed $metadata;

    #[Optional]
    public ?string $phone;

    #[Optional('postal_code')]
    public ?string $postalCode;

    /** @var value-of<Role>|null $role */
    #[Optional(enum: Role::class)]
    public ?string $role;

    #[Optional]
    public ?string $state;

    /**
     * `new PartyCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PartyCreateParams::with(name: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PartyCreateParams)->withName(...)->withType(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Type|value-of<Type> $type
     * @param Role|value-of<Role>|null $role
     */
    public static function with(
        string $name,
        Type|string $type,
        ?string $addressLine1 = null,
        ?string $city = null,
        ?string $country = null,
        ?string $email = null,
        mixed $metadata = null,
        ?string $phone = null,
        ?string $postalCode = null,
        Role|string|null $role = null,
        ?string $state = null,
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['type'] = $type;

        null !== $addressLine1 && $self['addressLine1'] = $addressLine1;
        null !== $city && $self['city'] = $city;
        null !== $country && $self['country'] = $country;
        null !== $email && $self['email'] = $email;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $phone && $self['phone'] = $phone;
        null !== $postalCode && $self['postalCode'] = $postalCode;
        null !== $role && $self['role'] = $role;
        null !== $state && $self['state'] = $state;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    public function withAddressLine1(string $addressLine1): self
    {
        $self = clone $this;
        $self['addressLine1'] = $addressLine1;

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

    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

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
