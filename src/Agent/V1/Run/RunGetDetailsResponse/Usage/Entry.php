<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run\RunGetDetailsResponse\Usage;

use CaseDev\Agent\V1\Run\RunGetDetailsResponse\Usage\Entry\Kind;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type EntryShape = array{
 *   id?: string|null,
 *   completionTokens?: int|null,
 *   costMicros?: int|null,
 *   endpoint?: string|null,
 *   kind?: null|Kind|value-of<Kind>,
 *   metadata?: mixed,
 *   method?: string|null,
 *   model?: string|null,
 *   promptTokens?: int|null,
 *   service?: string|null,
 *   statusCode?: int|null,
 *   timestamp?: \DateTimeInterface|null,
 *   totalTokens?: int|null,
 * }
 */
final class Entry implements BaseModel
{
    /** @use SdkModel<EntryShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional(nullable: true)]
    public ?int $completionTokens;

    #[Optional]
    public ?int $costMicros;

    #[Optional(nullable: true)]
    public ?string $endpoint;

    /** @var value-of<Kind>|null $kind */
    #[Optional(enum: Kind::class)]
    public ?string $kind;

    #[Optional]
    public mixed $metadata;

    #[Optional(nullable: true)]
    public ?string $method;

    #[Optional(nullable: true)]
    public ?string $model;

    #[Optional(nullable: true)]
    public ?int $promptTokens;

    #[Optional]
    public ?string $service;

    #[Optional(nullable: true)]
    public ?int $statusCode;

    #[Optional]
    public ?\DateTimeInterface $timestamp;

    #[Optional(nullable: true)]
    public ?int $totalTokens;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Kind|value-of<Kind>|null $kind
     */
    public static function with(
        ?string $id = null,
        ?int $completionTokens = null,
        ?int $costMicros = null,
        ?string $endpoint = null,
        Kind|string|null $kind = null,
        mixed $metadata = null,
        ?string $method = null,
        ?string $model = null,
        ?int $promptTokens = null,
        ?string $service = null,
        ?int $statusCode = null,
        ?\DateTimeInterface $timestamp = null,
        ?int $totalTokens = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $completionTokens && $self['completionTokens'] = $completionTokens;
        null !== $costMicros && $self['costMicros'] = $costMicros;
        null !== $endpoint && $self['endpoint'] = $endpoint;
        null !== $kind && $self['kind'] = $kind;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $method && $self['method'] = $method;
        null !== $model && $self['model'] = $model;
        null !== $promptTokens && $self['promptTokens'] = $promptTokens;
        null !== $service && $self['service'] = $service;
        null !== $statusCode && $self['statusCode'] = $statusCode;
        null !== $timestamp && $self['timestamp'] = $timestamp;
        null !== $totalTokens && $self['totalTokens'] = $totalTokens;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCompletionTokens(?int $completionTokens): self
    {
        $self = clone $this;
        $self['completionTokens'] = $completionTokens;

        return $self;
    }

    public function withCostMicros(int $costMicros): self
    {
        $self = clone $this;
        $self['costMicros'] = $costMicros;

        return $self;
    }

    public function withEndpoint(?string $endpoint): self
    {
        $self = clone $this;
        $self['endpoint'] = $endpoint;

        return $self;
    }

    /**
     * @param Kind|value-of<Kind> $kind
     */
    public function withKind(Kind|string $kind): self
    {
        $self = clone $this;
        $self['kind'] = $kind;

        return $self;
    }

    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    public function withMethod(?string $method): self
    {
        $self = clone $this;
        $self['method'] = $method;

        return $self;
    }

    public function withModel(?string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    public function withPromptTokens(?int $promptTokens): self
    {
        $self = clone $this;
        $self['promptTokens'] = $promptTokens;

        return $self;
    }

    public function withService(string $service): self
    {
        $self = clone $this;
        $self['service'] = $service;

        return $self;
    }

    public function withStatusCode(?int $statusCode): self
    {
        $self = clone $this;
        $self['statusCode'] = $statusCode;

        return $self;
    }

    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    public function withTotalTokens(?int $totalTokens): self
    {
        $self = clone $this;
        $self['totalTokens'] = $totalTokens;

        return $self;
    }
}
