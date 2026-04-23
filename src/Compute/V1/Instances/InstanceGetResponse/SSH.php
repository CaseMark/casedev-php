<?php

declare(strict_types=1);

namespace CaseDev\Compute\V1\Instances\InstanceGetResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type SSHShape = array{
 *   command?: string|null,
 *   host?: string|null,
 *   instructions?: list<mixed>|null,
 *   privateKey?: string|null,
 *   user?: string|null,
 * }
 */
final class SSH implements BaseModel
{
    /** @use SdkModel<SSHShape> */
    use SdkModel;

    #[Optional]
    public ?string $command;

    #[Optional]
    public ?string $host;

    /** @var list<mixed>|null $instructions */
    #[Optional(list: 'mixed')]
    public ?array $instructions;

    #[Optional]
    public ?string $privateKey;

    #[Optional]
    public ?string $user;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<mixed>|null $instructions
     */
    public static function with(
        ?string $command = null,
        ?string $host = null,
        ?array $instructions = null,
        ?string $privateKey = null,
        ?string $user = null,
    ): self {
        $self = new self;

        null !== $command && $self['command'] = $command;
        null !== $host && $self['host'] = $host;
        null !== $instructions && $self['instructions'] = $instructions;
        null !== $privateKey && $self['privateKey'] = $privateKey;
        null !== $user && $self['user'] = $user;

        return $self;
    }

    public function withCommand(string $command): self
    {
        $self = clone $this;
        $self['command'] = $command;

        return $self;
    }

    public function withHost(string $host): self
    {
        $self = clone $this;
        $self['host'] = $host;

        return $self;
    }

    /**
     * @param list<mixed> $instructions
     */
    public function withInstructions(array $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    public function withPrivateKey(string $privateKey): self
    {
        $self = clone $this;
        $self['privateKey'] = $privateKey;

        return $self;
    }

    public function withUser(string $user): self
    {
        $self = clone $this;
        $self['user'] = $user;

        return $self;
    }
}
