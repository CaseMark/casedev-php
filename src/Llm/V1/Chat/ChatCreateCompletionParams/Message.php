<?php

declare(strict_types=1);

namespace Casedev\Llm\V1\Chat\ChatCreateCompletionParams;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Llm\V1\Chat\ChatCreateCompletionParams\Message\Role;

/**
 * @phpstan-type MessageShape = array{
 *   content?: string|null, role?: value-of<Role>|null
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
     * @param Role|value-of<Role> $role
     */
    public static function with(
        ?string $content = null,
        Role|string|null $role = null
    ): self {
        $obj = new self;

        null !== $content && $obj['content'] = $content;
        null !== $role && $obj['role'] = $role;

        return $obj;
    }

    /**
     * The contents of the message.
     */
    public function withContent(string $content): self
    {
        $obj = clone $this;
        $obj['content'] = $content;

        return $obj;
    }

    /**
     * The role of the message author.
     *
     * @param Role|value-of<Role> $role
     */
    public function withRole(Role|string $role): self
    {
        $obj = clone $this;
        $obj['role'] = $role;

        return $obj;
    }
}
