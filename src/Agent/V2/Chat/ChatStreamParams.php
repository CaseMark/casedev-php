<?php

declare(strict_types=1);

namespace CaseDev\Agent\V2\Chat;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Relays OpenCode SSE events for this Daytona-backed chat runtime. Supports replay from buffered events using Last-Event-ID and transparently reconnects stopped or archived runtimes. Accepts either Bearer token auth or a short-lived stream token via query parameter. When both are provided, Bearer auth takes precedence.
 *
 * @see CaseDev\Services\Agent\V2\ChatService::streamStream()
 *
 * @phpstan-type ChatStreamParamsShape = array{
 *   token?: string|null, lastEventID?: int|null
 * }
 */
final class ChatStreamParams implements BaseModel
{
    /** @use SdkModel<ChatStreamParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Short-lived stream token from POST /agent/v2/chat/:id/stream-token. If provided, Bearer auth is not required.
     */
    #[Optional]
    public ?string $token;

    /**
     * Replay events after this sequence number.
     */
    #[Optional]
    public ?int $lastEventID;

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
        ?string $token = null,
        ?int $lastEventID = null
    ): self {
        $self = new self;

        null !== $token && $self['token'] = $token;
        null !== $lastEventID && $self['lastEventID'] = $lastEventID;

        return $self;
    }

    /**
     * Short-lived stream token from POST /agent/v2/chat/:id/stream-token. If provided, Bearer auth is not required.
     */
    public function withToken(string $token): self
    {
        $self = clone $this;
        $self['token'] = $token;

        return $self;
    }

    /**
     * Replay events after this sequence number.
     */
    public function withLastEventID(int $lastEventID): self
    {
        $self = clone $this;
        $self['lastEventID'] = $lastEventID;

        return $self;
    }
}
