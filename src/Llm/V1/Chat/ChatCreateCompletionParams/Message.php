<?php

declare(strict_types=1);

namespace CaseDev\Llm\V1\Chat\ChatCreateCompletionParams;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Llm\V1\Chat\ChatCreateCompletionParams\Message\Role;

/**
 * @phpstan-type MessageShape = array{
 *   content?: string|null, role?: null|Role|value-of<Role>
 * }
 */
final class Message implements BaseModel
{
    /** @use SdkModel<MessageShape> */
    use SdkModel;

    /**
     * The contents of the message.
     */
    #[Optional]
    public ?string $content;

    /**
     * The role of the message author.
     *
     * @var value-of<Role>|null $role
     */
    #[Optional(enum: Role::class)]
    public ?string $role;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Role|value-of<Role>|null $role
     */
    public static function with(
        ?string $content = null,
        Role|string|null $role = null
    ): self {
        $self = new self;

        null !== $content && $self['content'] = $content;
        null !== $role && $self['role'] = $role;

        return $self;
    }

    /**
     * The contents of the message.
     */
    public function withContent(string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    /**
     * The role of the message author.
     *
     * @param Role|value-of<Role> $role
     */
    public function withRole(Role|string $role): self
    {
        $self = clone $this;
        $self['role'] = $role;

        return $self;
    }
}
