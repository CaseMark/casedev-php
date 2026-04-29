<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Chat;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Core\Conversion\ListOf;

/**
 * Answers a pending runtime question for the chat session bound to this agent chat.
 *
 * @see CaseDev\Services\Agent\V1\ChatService::replyToQuestion()
 *
 * @phpstan-type ChatReplyToQuestionParamsShape = array{
 *   id: string, answers: list<list<string>>
 * }
 */
final class ChatReplyToQuestionParams implements BaseModel
{
    /** @use SdkModel<ChatReplyToQuestionParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * Answer selections for each prompt element in the pending question.
     *
     * @var list<list<string>> $answers
     */
    #[Required(list: new ListOf('string'))]
    public array $answers;

    /**
     * `new ChatReplyToQuestionParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ChatReplyToQuestionParams::with(id: ..., answers: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ChatReplyToQuestionParams)->withID(...)->withAnswers(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<list<string>> $answers
     */
    public static function with(string $id, array $answers): self
    {
        $self = new self;

        $self['id'] = $id;
        $self['answers'] = $answers;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Answer selections for each prompt element in the pending question.
     *
     * @param list<list<string>> $answers
     */
    public function withAnswers(array $answers): self
    {
        $self = clone $this;
        $self['answers'] = $answers;

        return $self;
    }
}
