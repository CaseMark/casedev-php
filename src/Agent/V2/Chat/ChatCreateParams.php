<?php

declare(strict_types=1);

namespace CaseDev\Agent\V2\Chat;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Creates a persistent OpenCode chat session backed by a Daytona runtime. Session state is retained and can be resumed or recovered across requests.
 *
 * @see CaseDev\Services\Agent\V2\ChatService::create()
 *
 * @phpstan-type ChatCreateParamsShape = array{
 *   idleTimeoutMs?: int|null,
 *   instructions?: string|null,
 *   model?: string|null,
 *   title?: string|null,
 *   vaultIDs?: list<string>|null,
 * }
 */
final class ChatCreateParams implements BaseModel
{
    /** @use SdkModel<ChatCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Idle timeout before the runtime is eligible to stop. Defaults to 15 minutes.
     */
    #[Optional(nullable: true)]
    public ?int $idleTimeoutMs;

    /**
     * Optional hidden app instructions merged into the chat runtime bootstrap and never exposed as a user message. Only accepted for privileged C3 system keys.
     */
    #[Optional(nullable: true)]
    public ?string $instructions;

    /**
     * Optional model override for the OpenCode session.
     */
    #[Optional(nullable: true)]
    public ?string $model;

    /**
     * Optional human-readable session title.
     */
    #[Optional]
    public ?string $title;

    /**
     * Restrict the chat session to specific vault IDs.
     *
     * @var list<string>|null $vaultIDs
     */
    #[Optional('vaultIds', list: 'string', nullable: true)]
    public ?array $vaultIDs;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $vaultIDs
     */
    public static function with(
        ?int $idleTimeoutMs = null,
        ?string $instructions = null,
        ?string $model = null,
        ?string $title = null,
        ?array $vaultIDs = null,
    ): self {
        $self = new self;

        null !== $idleTimeoutMs && $self['idleTimeoutMs'] = $idleTimeoutMs;
        null !== $instructions && $self['instructions'] = $instructions;
        null !== $model && $self['model'] = $model;
        null !== $title && $self['title'] = $title;
        null !== $vaultIDs && $self['vaultIDs'] = $vaultIDs;

        return $self;
    }

    /**
     * Idle timeout before the runtime is eligible to stop. Defaults to 15 minutes.
     */
    public function withIdleTimeoutMs(?int $idleTimeoutMs): self
    {
        $self = clone $this;
        $self['idleTimeoutMs'] = $idleTimeoutMs;

        return $self;
    }

    /**
     * Optional hidden app instructions merged into the chat runtime bootstrap and never exposed as a user message. Only accepted for privileged C3 system keys.
     */
    public function withInstructions(?string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * Optional model override for the OpenCode session.
     */
    public function withModel(?string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * Optional human-readable session title.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * Restrict the chat session to specific vault IDs.
     *
     * @param list<string>|null $vaultIDs
     */
    public function withVaultIDs(?array $vaultIDs): self
    {
        $self = clone $this;
        $self['vaultIDs'] = $vaultIDs;

        return $self;
    }
}
