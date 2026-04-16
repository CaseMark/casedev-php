<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Chat;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Creates a persistent OpenCode chat session backed by a Daytona or Vercel runtime. Session state is retained and can be resumed or recovered across requests.
 *
 * @see CaseDev\Services\Agent\V1\ChatService::create()
 *
 * @phpstan-type ChatCreateParamsShape = array{
 *   idleTimeoutMs?: int|null,
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
     * Idle timeout before session is eligible for snapshot/termination. Defaults to 15 minutes.
     */
    #[Optional(nullable: true)]
    public ?int $idleTimeoutMs;

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
        ?string $model = null,
        ?string $title = null,
        ?array $vaultIDs = null,
    ): self {
        $self = new self;

        null !== $idleTimeoutMs && $self['idleTimeoutMs'] = $idleTimeoutMs;
        null !== $model && $self['model'] = $model;
        null !== $title && $self['title'] = $title;
        null !== $vaultIDs && $self['vaultIDs'] = $vaultIDs;

        return $self;
    }

    /**
     * Idle timeout before session is eligible for snapshot/termination. Defaults to 15 minutes.
     */
    public function withIdleTimeoutMs(?int $idleTimeoutMs): self
    {
        $self = clone $this;
        $self['idleTimeoutMs'] = $idleTimeoutMs;

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
