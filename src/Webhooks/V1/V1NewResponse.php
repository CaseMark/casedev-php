<?php

declare(strict_types=1);

namespace Casedev\Webhooks\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type V1NewResponseShape = array{
 *   id?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   description?: string|null,
 *   events?: list<string>|null,
 *   isActive?: bool|null,
 *   secret?: string|null,
 *   url?: string|null,
 * }
 */
final class V1NewResponse implements BaseModel
{
    /** @use SdkModel<V1NewResponseShape> */
    use SdkModel;

    /**
     * Unique webhook endpoint ID.
     */
    #[Optional]
    public ?string $id;

    /**
     * Creation timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAt;

    /**
     * Webhook description.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Subscribed event types.
     *
     * @var list<string>|null $events
     */
    #[Optional(list: 'string')]
    public ?array $events;

    /**
     * Whether webhook is active.
     */
    #[Optional]
    public ?bool $isActive;

    /**
     * Webhook signing secret (only shown on creation).
     */
    #[Optional]
    public ?string $secret;

    /**
     * Webhook destination URL.
     */
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
     * @param list<string> $events
     */
    public static function with(
        ?string $id = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $description = null,
        ?array $events = null,
        ?bool $isActive = null,
        ?string $secret = null,
        ?string $url = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $description && $self['description'] = $description;
        null !== $events && $self['events'] = $events;
        null !== $isActive && $self['isActive'] = $isActive;
        null !== $secret && $self['secret'] = $secret;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * Unique webhook endpoint ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Webhook description.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Subscribed event types.
     *
     * @param list<string> $events
     */
    public function withEvents(array $events): self
    {
        $self = clone $this;
        $self['events'] = $events;

        return $self;
    }

    /**
     * Whether webhook is active.
     */
    public function withIsActive(bool $isActive): self
    {
        $self = clone $this;
        $self['isActive'] = $isActive;

        return $self;
    }

    /**
     * Webhook signing secret (only shown on creation).
     */
    public function withSecret(string $secret): self
    {
        $self = clone $this;
        $self['secret'] = $secret;

        return $self;
    }

    /**
     * Webhook destination URL.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
