<?php

declare(strict_types=1);

namespace Casedev\Convert\V1\V1WebhookParams;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * Result data for completed jobs.
 *
 * @phpstan-type ResultShape = array{
 *   durationSeconds?: float|null,
 *   fileSizeBytes?: int|null,
 *   storedFilename?: string|null,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * Processing duration in seconds.
     */
    #[Optional('duration_seconds')]
    public ?float $durationSeconds;

    /**
     * Size of processed file in bytes.
     */
    #[Optional('file_size_bytes')]
    public ?int $fileSizeBytes;

    /**
     * Filename where converted file is stored.
     */
    #[Optional('stored_filename')]
    public ?string $storedFilename;

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
        ?float $durationSeconds = null,
        ?int $fileSizeBytes = null,
        ?string $storedFilename = null,
    ): self {
        $self = new self;

        null !== $durationSeconds && $self['durationSeconds'] = $durationSeconds;
        null !== $fileSizeBytes && $self['fileSizeBytes'] = $fileSizeBytes;
        null !== $storedFilename && $self['storedFilename'] = $storedFilename;

        return $self;
    }

    /**
     * Processing duration in seconds.
     */
    public function withDurationSeconds(float $durationSeconds): self
    {
        $self = clone $this;
        $self['durationSeconds'] = $durationSeconds;

        return $self;
    }

    /**
     * Size of processed file in bytes.
     */
    public function withFileSizeBytes(int $fileSizeBytes): self
    {
        $self = clone $this;
        $self['fileSizeBytes'] = $fileSizeBytes;

        return $self;
    }

    /**
     * Filename where converted file is stored.
     */
    public function withStoredFilename(string $storedFilename): self
    {
        $self = clone $this;
        $self['storedFilename'] = $storedFilename;

        return $self;
    }
}
