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
        $obj = new self;

        null !== $finishReason && $obj['finishReason'] = $finishReason;
        null !== $index && $obj['index'] = $index;
        null !== $message && $obj['message'] = $message;

        return $obj;
    }

    public function withFinishReason(string $finishReason): self
    {
        $obj = clone $this;
        $obj['finishReason'] = $finishReason;

        return $obj;
    }

    public function withIndex(int $index): self
    {
        $obj = clone $this;
        $obj['index'] = $index;

        return $obj;
    }

    /**
     * @param Message|array{content?: string|null, role?: string|null} $message
     */
    public function withMessage(Message|array $message): self
    {
        $obj = clone $this;
        $obj['message'] = $message;

        return $obj;
    }
}
