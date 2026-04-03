<?php

declare(strict_types=1);

namespace CaseDev\Agent\V2\Chat;

use CaseDev\Agent\V2\Chat\ChatSendMessageParams\Part;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Sends a message to a Daytona-backed chat runtime and returns the complete response as a single JSON body. Blocks until the assistant turn completes.
 *
 * **When to use this endpoint:** Best for server-to-server integrations, background processing, or any context where you want the full response in one call without managing an SSE stream.
 *
 * **Alternatives:**
 * - `POST /chat/:id/respond` — streaming SSE with normalized events (recommended for custom chat UIs)
 *
 * @see CaseDev\Services\Agent\V2\ChatService::sendMessage()
 *
 * @phpstan-import-type PartShape from \CaseDev\Agent\V2\Chat\ChatSendMessageParams\Part
 *
 * @phpstan-type ChatSendMessageParamsShape = array{
 *   model?: string|null, parts?: list<Part|PartShape>|null
 * }
 */
final class ChatSendMessageParams implements BaseModel
{
    /** @use SdkModel<ChatSendMessageParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Optional model override. When provided, the runtime bootstrap config is updated so subsequent turns use this model. Conversation history is preserved.
     */
    #[Optional(nullable: true)]
    public ?string $model;

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
    public static function with(
        ?string $model = null,
        ?array $parts = null
    ): self {
        $self = new self;

        null !== $model && $self['model'] = $model;
        null !== $parts && $self['parts'] = $parts;

        return $self;
    }

    /**
     * Optional model override. When provided, the runtime bootstrap config is updated so subsequent turns use this model. Conversation history is preserved.
     */
    public function withModel(?string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

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
