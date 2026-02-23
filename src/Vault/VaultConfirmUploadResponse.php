<?php

declare(strict_types=1);

namespace Router\Vault;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Vault\VaultConfirmUploadResponse\Status;

/**
 * @phpstan-type VaultConfirmUploadResponseShape = array{
 *   alreadyConfirmed?: bool|null,
 *   objectID?: string|null,
 *   status?: null|Status|value-of<Status>,
 *   vaultID?: string|null,
 * }
 */
final class VaultConfirmUploadResponse implements BaseModel
{
    /** @use SdkModel<VaultConfirmUploadResponseShape> */
    use SdkModel;

    #[Optional]
    public ?bool $alreadyConfirmed;

    #[Optional('objectId')]
    public ?string $objectID;

    /** @var value-of<Status>|null $status */
    #[Optional(enum: Status::class)]
    public ?string $status;

    #[Optional('vaultId')]
    public ?string $vaultID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?bool $alreadyConfirmed = null,
        ?string $objectID = null,
        Status|string|null $status = null,
        ?string $vaultID = null,
    ): self {
        $self = new self;

        null !== $alreadyConfirmed && $self['alreadyConfirmed'] = $alreadyConfirmed;
        null !== $objectID && $self['objectID'] = $objectID;
        null !== $status && $self['status'] = $status;
        null !== $vaultID && $self['vaultID'] = $vaultID;

        return $self;
    }

    public function withAlreadyConfirmed(bool $alreadyConfirmed): self
    {
        $self = clone $this;
        $self['alreadyConfirmed'] = $alreadyConfirmed;

        return $self;
    }

    public function withObjectID(string $objectID): self
    {
        $self = clone $this;
        $self['objectID'] = $objectID;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withVaultID(string $vaultID): self
    {
        $self = clone $this;
        $self['vaultID'] = $vaultID;

        return $self;
    }
}
