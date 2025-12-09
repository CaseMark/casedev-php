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
        $obj = new self;

        null !== $durationSeconds && $obj['durationSeconds'] = $durationSeconds;
        null !== $fileSizeBytes && $obj['fileSizeBytes'] = $fileSizeBytes;
        null !== $storedFilename && $obj['storedFilename'] = $storedFilename;

        return $obj;
    }

    /**
     * Processing duration in seconds.
     */
    public function withDurationSeconds(float $durationSeconds): self
    {
        $obj = clone $this;
        $obj['durationSeconds'] = $durationSeconds;

        return $obj;
    }

    /**
     * Size of processed file in bytes.
     */
    public function withFileSizeBytes(int $fileSizeBytes): self
    {
        $obj = clone $this;
        $obj['fileSizeBytes'] = $fileSizeBytes;

        return $obj;
    }

    /**
     * Filename where converted file is stored.
     */
    public function withStoredFilename(string $storedFilename): self
    {
        $obj = clone $this;
        $obj['storedFilename'] = $storedFilename;

        return $obj;
    }
}
