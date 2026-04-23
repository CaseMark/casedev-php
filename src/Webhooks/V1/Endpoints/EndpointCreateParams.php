<?php

declare(strict_types=1);

namespace CaseDev\Webhooks\V1\Endpoints;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Webhooks\V1\Endpoints\EndpointCreateParams\ResourceScopes;

/**
 * Creates a webhook endpoint that receives platform events matching the supplied event-type filters. Returns the generated signing secret ONCE — the response is the only time it is shown in plaintext.
 *
 * @see CaseDev\Services\Webhooks\V1\EndpointsService::create()
 *
 * @phpstan-import-type ResourceScopesShape from \CaseDev\Webhooks\V1\Endpoints\EndpointCreateParams\ResourceScopes
 *
 * @phpstan-type EndpointCreateParamsShape = array{
 *   eventTypeFilters: list<string>,
 *   url: string,
 *   description?: string|null,
 *   resourceScopes?: null|ResourceScopes|ResourceScopesShape,
 * }
 */
final class EndpointCreateParams implements BaseModel
{
    /** @use SdkModel<EndpointCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Glob patterns of event types to deliver (e.g. "vault.*", "ocr.job.completed", "*").
     *
     * @var list<string> $eventTypeFilters
     */
    #[Required(list: 'string')]
    public array $eventTypeFilters;

    /**
     * HTTPS callback URL that will receive event deliveries.
     */
    #[Required]
    public string $url;

    /**
     * Human-readable label for this endpoint.
     */
    #[Optional]
    public ?string $description;

    /**
     * Optional per-resource allowlists. If vaultIds is set, only events for those vaults are delivered. Same for matterIds.
     */
    #[Optional]
    public ?ResourceScopes $resourceScopes;

    /**
     * `new EndpointCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EndpointCreateParams::with(eventTypeFilters: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EndpointCreateParams)->withEventTypeFilters(...)->withURL(...)
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
     * @param list<string> $eventTypeFilters
     * @param ResourceScopes|ResourceScopesShape|null $resourceScopes
     */
    public static function with(
        array $eventTypeFilters,
        string $url,
        ?string $description = null,
        ResourceScopes|array|null $resourceScopes = null,
    ): self {
        $self = new self;

        $self['eventTypeFilters'] = $eventTypeFilters;
        $self['url'] = $url;

        null !== $description && $self['description'] = $description;
        null !== $resourceScopes && $self['resourceScopes'] = $resourceScopes;

        return $self;
    }

    /**
     * Glob patterns of event types to deliver (e.g. "vault.*", "ocr.job.completed", "*").
     *
     * @param list<string> $eventTypeFilters
     */
    public function withEventTypeFilters(array $eventTypeFilters): self
    {
        $self = clone $this;
        $self['eventTypeFilters'] = $eventTypeFilters;

        return $self;
    }

    /**
     * HTTPS callback URL that will receive event deliveries.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Human-readable label for this endpoint.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Optional per-resource allowlists. If vaultIds is set, only events for those vaults are delivered. Same for matterIds.
     *
     * @param ResourceScopes|ResourceScopesShape $resourceScopes
     */
    public function withResourceScopes(
        ResourceScopes|array $resourceScopes
    ): self {
        $self = clone $this;
        $self['resourceScopes'] = $resourceScopes;

        return $self;
    }
}
