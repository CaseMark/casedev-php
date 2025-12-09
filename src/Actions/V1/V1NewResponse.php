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
 *   organizationId?: string|null,
 *   updatedAt?: string|null,
 *   version?: float|null,
 *   webhookEndpointId?: string|null,
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

    #[Optional]
    public ?string $organizationId;

    #[Optional]
    public ?string $updatedAt;

    #[Optional]
    public ?float $version;

    #[Optional]
    public ?string $webhookEndpointId;

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
        ?string $organizationId = null,
        ?string $updatedAt = null,
        ?float $version = null,
        ?string $webhookEndpointId = null,
    ): self {
        $obj = new self;

        null !== $id && $obj['id'] = $id;
        null !== $createdAt && $obj['createdAt'] = $createdAt;
        null !== $createdBy && $obj['createdBy'] = $createdBy;
        null !== $definition && $obj['definition'] = $definition;
        null !== $description && $obj['description'] = $description;
        null !== $isActive && $obj['isActive'] = $isActive;
        null !== $name && $obj['name'] = $name;
        null !== $organizationId && $obj['organizationId'] = $organizationId;
        null !== $updatedAt && $obj['updatedAt'] = $updatedAt;
        null !== $version && $obj['version'] = $version;
        null !== $webhookEndpointId && $obj['webhookEndpointId'] = $webhookEndpointId;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    public function withCreatedAt(string $createdAt): self
    {
        $obj = clone $this;
        $obj['createdAt'] = $createdAt;

        return $obj;
    }

    public function withCreatedBy(string $createdBy): self
    {
        $obj = clone $this;
        $obj['createdBy'] = $createdBy;

        return $obj;
    }

    public function withDefinition(mixed $definition): self
    {
        $obj = clone $this;
        $obj['definition'] = $definition;

        return $obj;
    }

    public function withDescription(string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    public function withIsActive(bool $isActive): self
    {
        $obj = clone $this;
        $obj['isActive'] = $isActive;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    public function withOrganizationID(string $organizationID): self
    {
        $obj = clone $this;
        $obj['organizationId'] = $organizationID;

        return $obj;
    }

    public function withUpdatedAt(string $updatedAt): self
    {
        $obj = clone $this;
        $obj['updatedAt'] = $updatedAt;

        return $obj;
    }

    public function withVersion(float $version): self
    {
        $obj = clone $this;
        $obj['version'] = $version;

        return $obj;
    }

    public function withWebhookEndpointID(string $webhookEndpointID): self
    {
        $obj = clone $this;
        $obj['webhookEndpointId'] = $webhookEndpointID;

        return $obj;
    }
}
