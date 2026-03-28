<?php

declare(strict_types=1);

namespace CaseDev\Agent\V2\Chat;

use CaseDev\Agent\V2\Chat\ChatNewResponse\Provider;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ChatNewResponseShape = array{
 *   id?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   idleTimeoutMs?: int|null,
 *   provider?: null|Provider|value-of<Provider>,
 *   runtimeState?: string|null,
 *   status?: string|null,
 * }
 */
final class ChatNewResponse implements BaseModel
{
    /** @use SdkModel<ChatNewResponseShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?\DateTimeInterface $createdAt;

    #[Optional]
    public ?int $idleTimeoutMs;

    /** @var value-of<Provider>|null $provider */
    #[Optional(enum: Provider::class)]
    public ?string $provider;

    #[Optional]
    public ?string $runtimeState;

    #[Optional]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Provider|value-of<Provider>|null $provider
     */
    public static function with(
        ?string $id = null,
        ?\DateTimeInterface $createdAt = null,
        ?int $idleTimeoutMs = null,
        Provider|string|null $provider = null,
        ?string $runtimeState = null,
        ?string $status = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $idleTimeoutMs && $self['idleTimeoutMs'] = $idleTimeoutMs;
        null !== $provider && $self['provider'] = $provider;
        null !== $runtimeState && $self['runtimeState'] = $runtimeState;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withIdleTimeoutMs(int $idleTimeoutMs): self
    {
        $self = clone $this;
        $self['idleTimeoutMs'] = $idleTimeoutMs;

        return $self;
    }

    /**
     * @param Provider|value-of<Provider> $provider
     */
    public function withProvider(Provider|string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    public function withRuntimeState(string $runtimeState): self
    {
        $self = clone $this;
        $self['runtimeState'] = $runtimeState;

        return $self;
    }

    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
