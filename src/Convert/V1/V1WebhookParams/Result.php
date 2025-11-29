<?php

declare(strict_types=1);

namespace Casedev\Convert\V1\V1WebhookParams;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * Result data for completed jobs.
 *
 * @phpstan-type ResultShape = array{
 *   duration_seconds?: float|null,
 *   file_size_bytes?: int|null,
 *   stored_filename?: string|null,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * Processing duration in seconds.
     */
    #[Api(optional: true)]
    public ?float $duration_seconds;

    /**
     * Size of processed file in bytes.
     */
    #[Api(optional: true)]
    public ?int $file_size_bytes;

    /**
     * Filename where converted file is stored.
     */
    #[Api(optional: true)]
    public ?string $stored_filename;

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
        ?float $duration_seconds = null,
        ?int $file_size_bytes = null,
        ?string $stored_filename = null,
    ): self {
        $obj = new self;

        null !== $duration_seconds && $obj->duration_seconds = $duration_seconds;
        null !== $file_size_bytes && $obj->file_size_bytes = $file_size_bytes;
        null !== $stored_filename && $obj->stored_filename = $stored_filename;

        return $obj;
    }

    /**
     * Processing duration in seconds.
     */
    public function withDurationSeconds(float $durationSeconds): self
    {
        $obj = clone $this;
        $obj->duration_seconds = $durationSeconds;

        return $obj;
    }

    /**
     * Size of processed file in bytes.
     */
    public function withFileSizeBytes(int $fileSizeBytes): self
    {
        $obj = clone $this;
        $obj->file_size_bytes = $fileSizeBytes;

        return $obj;
    }

    /**
     * Filename where converted file is stored.
     */
    public function withStoredFilename(string $storedFilename): self
    {
        $obj = clone $this;
        $obj->stored_filename = $storedFilename;

        return $obj;
    }
}
