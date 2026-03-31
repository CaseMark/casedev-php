<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\Parties;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Core\Conversion\MapOf;
use CaseDev\Matters\V1\Parties\PartyCreateParams\Type;

/**
 * Create a reusable legal party for the authenticated organization.
 *
 * @see CaseDev\Services\Matters\V1\PartiesService::create()
 *
 * @phpstan-type PartyCreateParamsShape = array{
 *   name: string,
 *   addresses?: list<array<string,mixed>>|null,
 *   customFields?: array<string,mixed>|null,
 *   email?: string|null,
 *   metadata?: array<string,mixed>|null,
 *   notes?: string|null,
 *   phone?: string|null,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class PartyCreateParams implements BaseModel
{
    /** @use SdkModel<PartyCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $name;

    /** @var list<array<string,mixed>>|null $addresses */
    #[Optional(list: new MapOf('mixed'))]
    public ?array $addresses;

    /** @var array<string,mixed>|null $customFields */
    #[Optional('custom_fields', map: 'mixed', nullable: true)]
    public ?array $customFields;

    #[Optional]
    public ?string $email;

    /** @var array<string,mixed>|null $metadata */
    #[Optional(map: 'mixed')]
    public ?array $metadata;

    #[Optional(nullable: true)]
    public ?string $notes;

    #[Optional]
    public ?string $phone;

    /** @var value-of<Type>|null $type */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * `new PartyCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PartyCreateParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PartyCreateParams)->withName(...)
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
     * @param list<array<string,mixed>>|null $addresses
     * @param array<string,mixed>|null $customFields
     * @param array<string,mixed>|null $metadata
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        string $name,
        ?array $addresses = null,
        ?array $customFields = null,
        ?string $email = null,
        ?array $metadata = null,
        ?string $notes = null,
        ?string $phone = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $addresses && $self['addresses'] = $addresses;
        null !== $customFields && $self['customFields'] = $customFields;
        null !== $email && $self['email'] = $email;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $notes && $self['notes'] = $notes;
        null !== $phone && $self['phone'] = $phone;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * @param list<array<string,mixed>> $addresses
     */
    public function withAddresses(array $addresses): self
    {
        $self = clone $this;
        $self['addresses'] = $addresses;

        return $self;
    }

    /**
     * @param array<string,mixed>|null $customFields
     */
    public function withCustomFields(?array $customFields): self
    {
        $self = clone $this;
        $self['customFields'] = $customFields;

        return $self;
    }

    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * @param array<string,mixed> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    public function withNotes(?string $notes): self
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

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
