<?php

declare(strict_types=1);

namespace Casedev\Llm\V1\Chat\ChatNewCompletionResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Llm\V1\Chat\ChatNewCompletionResponse\Choice\Message;

/**
 * @phpstan-type ChoiceShape = array{
 *   finishReason?: string|null, index?: int|null, message?: Message|null
 * }
 */
final class Choice implements BaseModel
{
    /** @use SdkModel<ChoiceShape> */
    use SdkModel;

    #[Optional('finish_reason')]
    public ?string $finishReason;

    #[Optional]
    public ?int $index;

    #[Optional]
    public ?Message $message;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Message|array{content?: string|null, role?: string|null} $message
     */
    public static function with(
        ?string $finishReason = null,
        ?int $index = null,
        Message|array|null $message = null,
    ): self {
        $self = new self;

        null !== $finishReason && $self['finishReason'] = $finishReason;
        null !== $index && $self['index'] = $index;
        null !== $message && $self['message'] = $message;

        return $self;
    }

    public function withFinishReason(string $finishReason): self
    {
        $self = clone $this;
        $self['finishReason'] = $finishReason;

        return $self;
    }

    public function withIndex(int $index): self
    {
        $self = clone $this;
        $self['index'] = $index;

        return $self;
    }

    /**
     * @param Message|array{content?: string|null, role?: string|null} $message
     */
    public function withMessage(Message|array $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }
}
