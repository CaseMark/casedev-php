<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\MatterParties;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Matters\V1\MatterParties\MatterPartyCreateParams\Role;

/**
 * Attach a reusable party to a matter with a matter-specific role.
 *
 * @see CaseDev\Services\Matters\V1\MatterPartiesService::create()
 *
 * @phpstan-type MatterPartyCreateParamsShape = array{
 *   partyID: string,
 *   role: Role|value-of<Role>,
 *   customFields?: array<string,mixed>|null,
 *   isPrimary?: bool|null,
 *   metadata?: array<string,mixed>|null,
 *   notes?: string|null,
 *   setAsClient?: bool|null,
 * }
 */
final class MatterPartyCreateParams implements BaseModel
{
    /** @use SdkModel<MatterPartyCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required('party_id')]
    public string $partyID;

    /** @var value-of<Role> $role */
    #[Required(enum: Role::class)]
    public string $role;

    /** @var array<string,mixed>|null $customFields */
    #[Optional('custom_fields', map: 'mixed', nullable: true)]
    public ?array $customFields;

    #[Optional('is_primary')]
    public ?bool $isPrimary;

    /** @var array<string,mixed>|null $metadata */
    #[Optional(map: 'mixed')]
    public ?array $metadata;

    #[Optional(nullable: true)]
    public ?string $notes;

    #[Optional('set_as_client')]
    public ?bool $setAsClient;

    /**
     * `new MatterPartyCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MatterPartyCreateParams::with(partyID: ..., role: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MatterPartyCreateParams)->withPartyID(...)->withRole(...)
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
     * @param Role|value-of<Role> $role
     * @param array<string,mixed>|null $customFields
     * @param array<string,mixed>|null $metadata
     */
    public static function with(
        string $partyID,
        Role|string $role,
        ?array $customFields = null,
        ?bool $isPrimary = null,
        ?array $metadata = null,
        ?string $notes = null,
        ?bool $setAsClient = null,
    ): self {
        $self = new self;

        $self['partyID'] = $partyID;
        $self['role'] = $role;

        null !== $customFields && $self['customFields'] = $customFields;
        null !== $isPrimary && $self['isPrimary'] = $isPrimary;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $notes && $self['notes'] = $notes;
        null !== $setAsClient && $self['setAsClient'] = $setAsClient;

        return $self;
    }

    public function withPartyID(string $partyID): self
    {
        $self = clone $this;
        $self['partyID'] = $partyID;

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

    /**
     * @param array<string,mixed>|null $customFields
     */
    public function withCustomFields(?array $customFields): self
    {
        $self = clone $this;
        $self['customFields'] = $customFields;

        return $self;
    }

    public function withIsPrimary(bool $isPrimary): self
    {
        $self = clone $this;
        $self['isPrimary'] = $isPrimary;

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

    public function withSetAsClient(bool $setAsClient): self
    {
        $self = clone $this;
        $self['setAsClient'] = $setAsClient;

        return $self;
    }
}
