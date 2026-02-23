<?php

declare(strict_types=1);

namespace Router\Memory\V1\V1NewResponse;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Memory\V1\V1NewResponse\Result\Event;

/**
 * @phpstan-type ResultShape = array{
 *   id?: string|null, event?: null|Event|value-of<Event>, memory?: string|null
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * Memory ID.
     */
    #[Optional]
    public ?string $id;

    /**
     * What happened to this memory.
     *
     * @var value-of<Event>|null $event
     */
    #[Optional(enum: Event::class)]
    public ?string $event;

    /**
     * Extracted memory text.
     */
    #[Optional]
    public ?string $memory;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Event|value-of<Event>|null $event
     */
    public static function with(
        ?string $id = null,
        Event|string|null $event = null,
        ?string $memory = null
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $event && $self['event'] = $event;
        null !== $memory && $self['memory'] = $memory;

        return $self;
    }

    /**
     * Memory ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * What happened to this memory.
     *
     * @param Event|value-of<Event> $event
     */
    public function withEvent(Event|string $event): self
    {
        $self = clone $this;
        $self['event'] = $event;

        return $self;
    }

    /**
     * Extracted memory text.
     */
    public function withMemory(string $memory): self
    {
        $self = clone $this;
        $self['memory'] = $memory;

        return $self;
    }
}
