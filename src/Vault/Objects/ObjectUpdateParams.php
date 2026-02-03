<?php

declare(strict_types=1);

namespace Casedev\Vault\Objects;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Update a document's filename, path, or metadata. Use this to rename files or organize them into virtual folders. The path is stored in metadata.path and can be used to build folder hierarchies in your application.
 *
 * @see Casedev\Services\Vault\ObjectsService::update()
 *
 * @phpstan-type ObjectUpdateParamsShape = array{
 *   id: string, filename?: string|null, metadata?: mixed, path?: string|null
 * }
 */
final class ObjectUpdateParams implements BaseModel
{
    /** @use SdkModel<ObjectUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * New filename for the document (affects display name and downloads).
     */
    #[Optional]
    public ?string $filename;

    /**
     * Additional metadata to merge with existing metadata.
     */
    #[Optional]
    public mixed $metadata;

    /**
     * Folder path for hierarchy preservation (e.g., '/Discovery/Depositions'). Set to null or empty string to remove.
     */
    #[Optional(nullable: true)]
    public ?string $path;

    /**
     * `new ObjectUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ObjectUpdateParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ObjectUpdateParams)->withID(...)
     * ```
     */
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
        string $id,
        ?string $filename = null,
        mixed $metadata = null,
        ?string $path = null,
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $filename && $self['filename'] = $filename;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $path && $self['path'] = $path;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * New filename for the document (affects display name and downloads).
     */
    public function withFilename(string $filename): self
    {
        $self = clone $this;
        $self['filename'] = $filename;

        return $self;
    }

    /**
     * Additional metadata to merge with existing metadata.
     */
    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Folder path for hierarchy preservation (e.g., '/Discovery/Depositions'). Set to null or empty string to remove.
     */
    public function withPath(?string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }
}
