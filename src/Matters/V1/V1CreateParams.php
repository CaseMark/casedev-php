<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Matters\V1\V1CreateParams\Status;
use CaseDev\Matters\V1\V1CreateParams\Vault;

/**
 * Create a new legal matter and optionally link an existing primary vault.
 *
 * @see CaseDev\Services\Matters\V1Service::create()
 *
 * @phpstan-import-type VaultShape from \CaseDev\Matters\V1\V1CreateParams\Vault
 *
 * @phpstan-type V1CreateParamsShape = array{
 *   title: string,
 *   billing?: array<string,mixed>|null,
 *   clientName?: string|null,
 *   clientPartyID?: string|null,
 *   customFields?: array<string,mixed>|null,
 *   description?: string|null,
 *   displayID?: string|null,
 *   importantDates?: array<string,mixed>|null,
 *   jurisdiction?: array<string,mixed>|null,
 *   matterType?: string|null,
 *   metadata?: array<string,mixed>|null,
 *   practiceArea?: string|null,
 *   responsibleAttorneyID?: string|null,
 *   status?: null|Status|value-of<Status>,
 *   subtype?: string|null,
 *   vault?: null|Vault|VaultShape,
 *   vaultID?: string|null,
 * }
 */
final class V1CreateParams implements BaseModel
{
    /** @use SdkModel<V1CreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $title;

    /** @var array<string,mixed>|null $billing */
    #[Optional(map: 'mixed')]
    public ?array $billing;

    #[Optional('client_name')]
    public ?string $clientName;

    #[Optional('client_party_id', nullable: true)]
    public ?string $clientPartyID;

    /** @var array<string,mixed>|null $customFields */
    #[Optional('custom_fields', map: 'mixed')]
    public ?array $customFields;

    #[Optional]
    public ?string $description;

    #[Optional('display_id')]
    public ?string $displayID;

    /** @var array<string,mixed>|null $importantDates */
    #[Optional('important_dates', map: 'mixed')]
    public ?array $importantDates;

    /** @var array<string,mixed>|null $jurisdiction */
    #[Optional(map: 'mixed')]
    public ?array $jurisdiction;

    #[Optional('matter_type')]
    public ?string $matterType;

    /** @var array<string,mixed>|null $metadata */
    #[Optional(map: 'mixed')]
    public ?array $metadata;

    #[Optional('practice_area')]
    public ?string $practiceArea;

    #[Optional('responsible_attorney_id')]
    public ?string $responsibleAttorneyID;

    /** @var value-of<Status>|null $status */
    #[Optional(enum: Status::class)]
    public ?string $status;

    #[Optional]
    public ?string $subtype;

    #[Optional]
    public ?Vault $vault;

    #[Optional('vault_id')]
    public ?string $vaultID;

    /**
     * `new V1CreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1CreateParams::with(title: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1CreateParams)->withTitle(...)
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
     * @param array<string,mixed>|null $billing
     * @param array<string,mixed>|null $customFields
     * @param array<string,mixed>|null $importantDates
     * @param array<string,mixed>|null $jurisdiction
     * @param array<string,mixed>|null $metadata
     * @param Status|value-of<Status>|null $status
     * @param Vault|VaultShape|null $vault
     */
    public static function with(
        string $title,
        ?array $billing = null,
        ?string $clientName = null,
        ?string $clientPartyID = null,
        ?array $customFields = null,
        ?string $description = null,
        ?string $displayID = null,
        ?array $importantDates = null,
        ?array $jurisdiction = null,
        ?string $matterType = null,
        ?array $metadata = null,
        ?string $practiceArea = null,
        ?string $responsibleAttorneyID = null,
        Status|string|null $status = null,
        ?string $subtype = null,
        Vault|array|null $vault = null,
        ?string $vaultID = null,
    ): self {
        $self = new self;

        $self['title'] = $title;

        null !== $billing && $self['billing'] = $billing;
        null !== $clientName && $self['clientName'] = $clientName;
        null !== $clientPartyID && $self['clientPartyID'] = $clientPartyID;
        null !== $customFields && $self['customFields'] = $customFields;
        null !== $description && $self['description'] = $description;
        null !== $displayID && $self['displayID'] = $displayID;
        null !== $importantDates && $self['importantDates'] = $importantDates;
        null !== $jurisdiction && $self['jurisdiction'] = $jurisdiction;
        null !== $matterType && $self['matterType'] = $matterType;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $practiceArea && $self['practiceArea'] = $practiceArea;
        null !== $responsibleAttorneyID && $self['responsibleAttorneyID'] = $responsibleAttorneyID;
        null !== $status && $self['status'] = $status;
        null !== $subtype && $self['subtype'] = $subtype;
        null !== $vault && $self['vault'] = $vault;
        null !== $vaultID && $self['vaultID'] = $vaultID;

        return $self;
    }

    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * @param array<string,mixed> $billing
     */
    public function withBilling(array $billing): self
    {
        $self = clone $this;
        $self['billing'] = $billing;

        return $self;
    }

    public function withClientName(string $clientName): self
    {
        $self = clone $this;
        $self['clientName'] = $clientName;

        return $self;
    }

    public function withClientPartyID(?string $clientPartyID): self
    {
        $self = clone $this;
        $self['clientPartyID'] = $clientPartyID;

        return $self;
    }

    /**
     * @param array<string,mixed> $customFields
     */
    public function withCustomFields(array $customFields): self
    {
        $self = clone $this;
        $self['customFields'] = $customFields;

        return $self;
    }

    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withDisplayID(string $displayID): self
    {
        $self = clone $this;
        $self['displayID'] = $displayID;

        return $self;
    }

    /**
     * @param array<string,mixed> $importantDates
     */
    public function withImportantDates(array $importantDates): self
    {
        $self = clone $this;
        $self['importantDates'] = $importantDates;

        return $self;
    }

    /**
     * @param array<string,mixed> $jurisdiction
     */
    public function withJurisdiction(array $jurisdiction): self
    {
        $self = clone $this;
        $self['jurisdiction'] = $jurisdiction;

        return $self;
    }

    public function withMatterType(string $matterType): self
    {
        $self = clone $this;
        $self['matterType'] = $matterType;

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

    public function withPracticeArea(string $practiceArea): self
    {
        $self = clone $this;
        $self['practiceArea'] = $practiceArea;

        return $self;
    }

    public function withResponsibleAttorneyID(
        string $responsibleAttorneyID
    ): self {
        $self = clone $this;
        $self['responsibleAttorneyID'] = $responsibleAttorneyID;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withSubtype(string $subtype): self
    {
        $self = clone $this;
        $self['subtype'] = $subtype;

        return $self;
    }

    /**
     * @param Vault|VaultShape $vault
     */
    public function withVault(Vault|array $vault): self
    {
        $self = clone $this;
        $self['vault'] = $vault;

        return $self;
    }

    public function withVaultID(string $vaultID): self
    {
        $self = clone $this;
        $self['vaultID'] = $vaultID;

        return $self;
    }
}
