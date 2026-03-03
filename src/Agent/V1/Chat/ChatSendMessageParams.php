<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Chat;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Proxies a message to the OpenCode session bound to this chat.
 *
 * @see CaseDev\Services\Agent\V1\ChatService::sendMessage()
 *
 * @phpstan-type ChatSendMessageParamsShape = array{body: mixed}
 */
final class ChatSendMessageParams implements BaseModel
{
    /** @use SdkModel<ChatSendMessageParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * OpenCode message payload. Passed through 1:1.
     */
    #[Required]
    public mixed $body;

    /**
     * `new ChatSendMessageParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ChatSendMessageParams::with(body: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ChatSendMessageParams)->withBody(...)
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
     */
    public static function with(mixed $body): self
    {
        $self = new self;

        $self['body'] = $body;

        return $self;
    }

    /**
     * OpenCode message payload. Passed through 1:1.
     */
    public function withBody(mixed $body): self
    {
        $self = clone $this;
        $self['body'] = $body;

        return $self;
    }
}
