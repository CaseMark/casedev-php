<?php

declare(strict_types=1);

namespace Casedev\Voice\Transcription;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Voice\Transcription\TranscriptionNewResponse\Status;

/**
 * @phpstan-type TranscriptionNewResponseShape = array{
 *   id?: string|null,
 *   sourceObjectID?: string|null,
 *   status?: null|Status|value-of<Status>,
 *   vaultID?: string|null,
 * }
 */
final class TranscriptionNewResponse implements BaseModel
{
    /** @use SdkModel<TranscriptionNewResponseShape> */
    use SdkModel;

    /**
     * Unique transcription job ID.
     */
    #[Optional]
    public ?string $id;

    /**
     * Source audio object ID (only for vault-based transcription).
     */
    #[Optional('source_object_id')]
    public ?string $sourceObjectID;

    /**
     * Current status of the transcription job.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * Vault ID (only for vault-based transcription).
     */
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
     *
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $id = null,
        ?string $sourceObjectID = null,
        Status|string|null $status = null,
        ?string $vaultID = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $sourceObjectID && $self['sourceObjectID'] = $sourceObjectID;
        null !== $status && $self['status'] = $status;
        null !== $vaultID && $self['vaultID'] = $vaultID;

        return $self;
    }

    /**
     * Unique transcription job ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Source audio object ID (only for vault-based transcription).
     */
    public function withSourceObjectID(string $sourceObjectID): self
    {
        $self = clone $this;
        $self['sourceObjectID'] = $sourceObjectID;

        return $self;
    }

    /**
     * Current status of the transcription job.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Vault ID (only for vault-based transcription).
     */
    public function withVaultID(string $vaultID): self
    {
        $self = clone $this;
        $self['vaultID'] = $vaultID;

        return $self;
    }
}
