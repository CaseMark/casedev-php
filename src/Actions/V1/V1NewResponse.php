<?php

declare(strict_types=1);

namespace Casedev\Actions\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkResponse;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Core\Conversion\Contracts\ResponseConverter;

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
final class V1NewResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<V1NewResponseShape> */
    use SdkModel;

    use SdkResponse;

    #[Api(optional: true)]
    public ?string $id;

    #[Api(optional: true)]
    public ?string $createdAt;

    #[Api(optional: true)]
    public ?string $createdBy;

    #[Api(optional: true)]
    public mixed $definition;

    #[Api(optional: true)]
    public ?string $description;

    #[Api(optional: true)]
    public ?bool $isActive;

    #[Api(optional: true)]
    public ?string $name;

    #[Api(optional: true)]
    public ?string $organizationId;

    #[Api(optional: true)]
    public ?string $updatedAt;

    #[Api(optional: true)]
    public ?float $version;

    #[Api(optional: true)]
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

        null !== $id && $obj->id = $id;
        null !== $createdAt && $obj->createdAt = $createdAt;
        null !== $createdBy && $obj->createdBy = $createdBy;
        null !== $definition && $obj->definition = $definition;
        null !== $description && $obj->description = $description;
        null !== $isActive && $obj->isActive = $isActive;
        null !== $name && $obj->name = $name;
        null !== $organizationId && $obj->organizationId = $organizationId;
        null !== $updatedAt && $obj->updatedAt = $updatedAt;
        null !== $version && $obj->version = $version;
        null !== $webhookEndpointId && $obj->webhookEndpointId = $webhookEndpointId;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    public function withCreatedAt(string $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    public function withCreatedBy(string $createdBy): self
    {
        $obj = clone $this;
        $obj->createdBy = $createdBy;

        return $obj;
    }

    public function withDefinition(mixed $definition): self
    {
        $obj = clone $this;
        $obj->definition = $definition;

        return $obj;
    }

    public function withDescription(string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    public function withIsActive(bool $isActive): self
    {
        $obj = clone $this;
        $obj->isActive = $isActive;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    public function withOrganizationID(string $organizationID): self
    {
        $obj = clone $this;
        $obj->organizationId = $organizationID;

        return $obj;
    }

    public function withUpdatedAt(string $updatedAt): self
    {
        $obj = clone $this;
        $obj->updatedAt = $updatedAt;

        return $obj;
    }

    public function withVersion(float $version): self
    {
        $obj = clone $this;
        $obj->version = $version;

        return $obj;
    }

    public function withWebhookEndpointID(string $webhookEndpointID): self
    {
        $obj = clone $this;
        $obj->webhookEndpointId = $webhookEndpointID;

        return $obj;
    }
}
