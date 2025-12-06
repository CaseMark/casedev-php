<?php

declare(strict_types=1);

namespace Casedev\Llm\V1\Chat\ChatNewCompletionResponse;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Llm\V1\Chat\ChatNewCompletionResponse\Choice\Message;

/**
 * @phpstan-type ChoiceShape = array{
 *   finish_reason?: string|null, index?: int|null, message?: Message|null
 * }
 */
final class Choice implements BaseModel
{
    /** @use SdkModel<ChoiceShape> */
    use SdkModel;

    #[Api(optional: true)]
    public ?string $finish_reason;

    #[Api(optional: true)]
    public ?int $index;

    #[Api(optional: true)]
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
        ?string $finish_reason = null,
        ?int $index = null,
        Message|array|null $message = null,
    ): self {
        $obj = new self;

        null !== $finish_reason && $obj['finish_reason'] = $finish_reason;
        null !== $index && $obj['index'] = $index;
        null !== $message && $obj['message'] = $message;

        return $obj;
    }

    public function withFinishReason(string $finishReason): self
    {
        $obj = clone $this;
        $obj['finish_reason'] = $finishReason;

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
