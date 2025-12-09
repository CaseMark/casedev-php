<?php

declare(strict_types=1);

namespace Casedev\Webhooks\V1;

use Casedev\Core\Attributes\Api;
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
    #[Api(optional: true)]
    public ?string $id;

    /**
     * Creation timestamp.
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $createdAt;

    /**
     * Webhook description.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $description;

    /**
     * Subscribed event types.
     *
     * @var list<string>|null $events
     */
    #[Api(list: 'string', optional: true)]
    public ?array $events;

    /**
     * Whether webhook is active.
     */
    #[Api(optional: true)]
    public ?bool $isActive;

    /**
     * Webhook signing secret (only shown on creation).
     */
    #[Api(optional: true)]
    public ?string $secret;

    /**
     * Webhook destination URL.
     */
    #[Api(optional: true)]
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
        $obj = new self;

        null !== $id && $obj['id'] = $id;
        null !== $createdAt && $obj['createdAt'] = $createdAt;
        null !== $description && $obj['description'] = $description;
        null !== $events && $obj['events'] = $events;
        null !== $isActive && $obj['isActive'] = $isActive;
        null !== $secret && $obj['secret'] = $secret;
        null !== $url && $obj['url'] = $url;

        return $obj;
    }

    /**
     * Unique webhook endpoint ID.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    /**
     * Creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['createdAt'] = $createdAt;

        return $obj;
    }

    /**
     * Webhook description.
     */
    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    /**
     * Subscribed event types.
     *
     * @param list<string> $events
     */
    public function withEvents(array $events): self
    {
        $obj = clone $this;
        $obj['events'] = $events;

        return $obj;
    }

    /**
     * Whether webhook is active.
     */
    public function withIsActive(bool $isActive): self
    {
        $obj = clone $this;
        $obj['isActive'] = $isActive;

        return $obj;
    }

    /**
     * Webhook signing secret (only shown on creation).
     */
    public function withSecret(string $secret): self
    {
        $obj = clone $this;
        $obj['secret'] = $secret;

        return $obj;
    }

    /**
     * Webhook destination URL.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj['url'] = $url;

        return $obj;
    }
}
