<?php

declare(strict_types=1);

namespace Casedev\Llm\V1\Chat\ChatNewCompletionResponse\Choice;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type MessageShape = array{content?: string|null, role?: string|null}
 */
final class Message implements BaseModel
{
    /** @use SdkModel<MessageShape> */
    use SdkModel;

    #[Optional]
    public ?string $content;

    #[Optional]
    public ?string $role;

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
        ?string $content = null,
        ?string $role = null
    ): self {
        $self = new self;

        null !== $content && $self['content'] = $content;
        null !== $role && $self['role'] = $role;

        return $self;
    }

    public function withContent(string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    public function withRole(string $role): self
    {
        $self = clone $this;
        $self['role'] = $role;

        return $self;
    }
}
