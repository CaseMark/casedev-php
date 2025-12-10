<?php

declare(strict_types=1);

namespace Casedev\Actions\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type V1NewResponseShape = array{
 *   id?: string|null,
 *   createdAt?: string|null,
 *   createdBy?: string|null,
 *   definition?: mixed,
 *   description?: string|null,
 *   isActive?: bool|null,
 *   name?: string|null,
 *   organizationID?: string|null,
 *   updatedAt?: string|null,
 *   version?: float|null,
 *   webhookEndpointID?: string|null,
 * }
 */
final class V1NewResponse implements BaseModel
{
    /** @use SdkModel<V1NewResponseShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?string $createdAt;

    #[Optional]
    public ?string $createdBy;

    #[Optional]
    public mixed $definition;

    #[Optional]
    public ?string $description;

    #[Optional]
    public ?bool $isActive;

    #[Optional]
    public ?string $name;

    #[Optional('organizationId')]
    public ?string $organizationID;

    #[Optional]
    public ?string $updatedAt;

    #[Optional]
    public ?float $version;

    #[Optional('webhookEndpointId')]
    public ?string $webhookEndpointID;

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
        ?string $id = null,
        ?string $createdAt = null,
        ?string $createdBy = null,
        mixed $definition = null,
        ?string $description = null,
        ?bool $isActive = null,
        ?string $name = null,
        ?string $organizationID = null,
        ?string $updatedAt = null,
        ?float $version = null,
        ?string $webhookEndpointID = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $createdBy && $self['createdBy'] = $createdBy;
        null !== $definition && $self['definition'] = $definition;
        null !== $description && $self['description'] = $description;
        null !== $isActive && $self['isActive'] = $isActive;
        null !== $name && $self['name'] = $name;
        null !== $organizationID && $self['organizationID'] = $organizationID;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;
        null !== $version && $self['version'] = $version;
        null !== $webhookEndpointID && $self['webhookEndpointID'] = $webhookEndpointID;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withCreatedBy(string $createdBy): self
    {
        $self = clone $this;
        $self['createdBy'] = $createdBy;

        return $self;
    }

    public function withDefinition(mixed $definition): self
    {
        $self = clone $this;
        $self['definition'] = $definition;

        return $self;
    }

    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withIsActive(bool $isActive): self
    {
        $self = clone $this;
        $self['isActive'] = $isActive;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withOrganizationID(string $organizationID): self
    {
        $self = clone $this;
        $self['organizationID'] = $organizationID;

        return $self;
    }

    public function withUpdatedAt(string $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    public function withVersion(float $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }

    public function withWebhookEndpointID(string $webhookEndpointID): self
    {
        $self = clone $this;
        $self['webhookEndpointID'] = $webhookEndpointID;

        return $self;
    }
}
