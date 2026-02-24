<?php

declare(strict_types=1);

namespace CaseDev\Vault\Graphrag;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type GraphragInitResponseShape = array{
 *   message?: string|null,
 *   status?: string|null,
 *   success?: bool|null,
 *   vaultID?: string|null,
 * }
 */
final class GraphragInitResponse implements BaseModel
{
    /** @use SdkModel<GraphragInitResponseShape> */
    use SdkModel;

    #[Optional]
    public ?string $message;

    #[Optional]
    public ?string $status;

    #[Optional]
    public ?bool $success;

    #[Optional('vault_id')]
    public ?string $vaultID;

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
        ?string $message = null,
        ?string $status = null,
        ?bool $success = null,
        ?string $vaultID = null,
    ): self {
        $self = new self;

        null !== $message && $self['message'] = $message;
        null !== $status && $self['status'] = $status;
        null !== $success && $self['success'] = $success;
        null !== $vaultID && $self['vaultID'] = $vaultID;

        return $self;
    }

    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    public function withVaultID(string $vaultID): self
    {
        $self = clone $this;
        $self['vaultID'] = $vaultID;

        return $self;
    }
}
