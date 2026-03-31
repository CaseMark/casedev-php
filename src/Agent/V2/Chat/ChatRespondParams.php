<?php

declare(strict_types=1);

namespace CaseDev\Agent\V2\Chat;

use CaseDev\Agent\V2\Chat\ChatRespondParams\Part;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Streams a single assistant turn from a Daytona-backed chat runtime as normalized SSE events with stable turn, message, and part IDs. Emits events: `turn.started`, `turn.status`, `message.created`, `message.part.updated`, `message.completed`, `session.usage`, `turn.completed`.
 *
 * **When to use this endpoint:** Recommended for building custom chat UIs that need real-time streaming progress. This is the primary streaming endpoint for new integrations.
 *
 * **Alternatives:**
 * - `POST /chat/:id/message` — synchronous, returns complete response as JSON (best for server-to-server)
 *
 * @see CaseDev\Services\Agent\V2\ChatService::respondStream()
 *
 * @phpstan-import-type PartShape from \CaseDev\Agent\V2\Chat\ChatRespondParams\Part
 *
 * @phpstan-type ChatRespondParamsShape = array{parts?: list<Part|PartShape>|null}
 */
final class ChatRespondParams implements BaseModel
{
    /** @use SdkModel<ChatRespondParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Message content parts. Currently only "text" type is supported. Additional types (e.g. file, image) may be added in future versions.
     *
     * @var list<Part>|null $parts
     */
    #[Optional(list: Part::class)]
    public ?array $parts;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Part|PartShape>|null $parts
     */
    public static function with(?array $parts = null): self
    {
        $self = new self;

        null !== $parts && $self['parts'] = $parts;

        return $self;
    }

    /**
     * Message content parts. Currently only "text" type is supported. Additional types (e.g. file, image) may be added in future versions.
     *
     * @param list<Part|PartShape> $parts
     */
    public function withParts(array $parts): self
    {
        $self = clone $this;
        $self['parts'] = $parts;

        return $self;
    }
}
