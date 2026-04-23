<?php

declare(strict_types=1);

namespace CaseDev\Webhooks\V1\Endpoints;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Webhooks\V1\Endpoints\EndpointUpdateParams\ResourceScopes;
use CaseDev\Webhooks\V1\Endpoints\EndpointUpdateParams\Status;

/**
 * Partially updates a webhook endpoint. Any omitted field is left unchanged. Signing secrets are rotated via the separate /rotate_secret endpoint.
 *
 * @see CaseDev\Services\Webhooks\V1\EndpointsService::update()
 *
 * @phpstan-import-type ResourceScopesShape from \CaseDev\Webhooks\V1\Endpoints\EndpointUpdateParams\ResourceScopes
 *
 * @phpstan-type EndpointUpdateParamsShape = array{
 *   description?: string|null,
 *   eventTypeFilters?: list<string>|null,
 *   resourceScopes?: null|ResourceScopes|ResourceScopesShape,
 *   status?: null|Status|value-of<Status>,
 *   url?: string|null,
 * }
 */
final class EndpointUpdateParams implements BaseModel
{
    /** @use SdkModel<EndpointUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional(nullable: true)]
    public ?string $description;

    /** @var list<string>|null $eventTypeFilters */
    #[Optional(list: 'string')]
    public ?array $eventTypeFilters;

    #[Optional(nullable: true)]
    public ?ResourceScopes $resourceScopes;

    /** @var value-of<Status>|null $status */
    #[Optional(enum: Status::class)]
    public ?string $status;

    #[Optional]
    public ?string $url;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $eventTypeFilters
     * @param ResourceScopes|ResourceScopesShape|null $resourceScopes
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $description = null,
        ?array $eventTypeFilters = null,
        ResourceScopes|array|null $resourceScopes = null,
        Status|string|null $status = null,
        ?string $url = null,
    ): self {
        $self = new self;

        null !== $description && $self['description'] = $description;
        null !== $eventTypeFilters && $self['eventTypeFilters'] = $eventTypeFilters;
        null !== $resourceScopes && $self['resourceScopes'] = $resourceScopes;
        null !== $status && $self['status'] = $status;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * @param list<string> $eventTypeFilters
     */
    public function withEventTypeFilters(array $eventTypeFilters): self
    {
        $self = clone $this;
        $self['eventTypeFilters'] = $eventTypeFilters;

        return $self;
    }

    /**
     * @param ResourceScopes|ResourceScopesShape|null $resourceScopes
     */
    public function withResourceScopes(
        ResourceScopes|array|null $resourceScopes
    ): self {
        $self = clone $this;
        $self['resourceScopes'] = $resourceScopes;

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

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
