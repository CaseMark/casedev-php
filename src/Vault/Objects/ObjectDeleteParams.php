<?php

declare(strict_types=1);

namespace Casedev\Vault\Objects;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Vault\Objects\ObjectDeleteParams\Force;

/**
 * Permanently deletes a document from the vault including all associated vectors, chunks, graph data, and the original file. This operation cannot be undone.
 *
 * @see Casedev\Services\Vault\ObjectsService::delete()
 *
 * @phpstan-type ObjectDeleteParamsShape = array{
 *   id: string, force?: null|Force|value-of<Force>
 * }
 */
final class ObjectDeleteParams implements BaseModel
{
    /** @use SdkModel<ObjectDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * Force delete a stuck document that is still in 'processing' state. Use this if a document got stuck during ingestion (e.g., OCR timeout).
     *
     * @var value-of<Force>|null $force
     */
    #[Optional(enum: Force::class)]
    public ?string $force;

    /**
     * `new ObjectDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ObjectDeleteParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ObjectDeleteParams)->withID(...)
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
     *
     * @param Force|value-of<Force>|null $force
     */
    public static function with(string $id, Force|string|null $force = null): self
    {
        $self = new self;

        $self['id'] = $id;

        null !== $force && $self['force'] = $force;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Force delete a stuck document that is still in 'processing' state. Use this if a document got stuck during ingestion (e.g., OCR timeout).
     *
     * @param Force|value-of<Force> $force
     */
    public function withForce(Force|string $force): self
    {
        $self = clone $this;
        $self['force'] = $force;

        return $self;
    }
}
