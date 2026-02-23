<?php

declare(strict_types=1);

namespace Router\Agent\V1\Run\RunGetDetailsResponse;

use Router\Agent\V1\Run\RunGetDetailsResponse\Step\Type;
use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type StepShape = array{
 *   id?: string|null,
 *   content?: string|null,
 *   durationMs?: int|null,
 *   timestamp?: \DateTimeInterface|null,
 *   toolInput?: mixed,
 *   toolName?: string|null,
 *   toolOutput?: mixed,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class Step implements BaseModel
{
    /** @use SdkModel<StepShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional(nullable: true)]
    public ?string $content;

    #[Optional(nullable: true)]
    public ?int $durationMs;

    #[Optional]
    public ?\DateTimeInterface $timestamp;

    #[Optional]
    public mixed $toolInput;

    #[Optional(nullable: true)]
    public ?string $toolName;

    #[Optional]
    public mixed $toolOutput;

    /** @var value-of<Type>|null $type */
    #[Optional(enum: Type::class)]
    public ?string $type;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        ?string $id = null,
        ?string $content = null,
        ?int $durationMs = null,
        ?\DateTimeInterface $timestamp = null,
        mixed $toolInput = null,
        ?string $toolName = null,
        mixed $toolOutput = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $content && $self['content'] = $content;
        null !== $durationMs && $self['durationMs'] = $durationMs;
        null !== $timestamp && $self['timestamp'] = $timestamp;
        null !== $toolInput && $self['toolInput'] = $toolInput;
        null !== $toolName && $self['toolName'] = $toolName;
        null !== $toolOutput && $self['toolOutput'] = $toolOutput;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withContent(?string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    public function withDurationMs(?int $durationMs): self
    {
        $self = clone $this;
        $self['durationMs'] = $durationMs;

        return $self;
    }

    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    public function withToolInput(mixed $toolInput): self
    {
        $self = clone $this;
        $self['toolInput'] = $toolInput;

        return $self;
    }

    public function withToolName(?string $toolName): self
    {
        $self = clone $this;
        $self['toolName'] = $toolName;

        return $self;
    }

    public function withToolOutput(mixed $toolOutput): self
    {
        $self = clone $this;
        $self['toolOutput'] = $toolOutput;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
