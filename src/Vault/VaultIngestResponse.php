<?php

declare(strict_types=1);

namespace Router\Vault;

use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Vault\VaultIngestResponse\Status;

/**
 * @phpstan-type VaultIngestResponseShape = array{
 *   enableGraphRag: bool,
 *   message: string,
 *   objectID: string,
 *   status: Status|value-of<Status>,
 *   workflowID: string|null,
 * }
 */
final class VaultIngestResponse implements BaseModel
{
    /** @use SdkModel<VaultIngestResponseShape> */
    use SdkModel;

    /**
     * Always false - GraphRAG must be triggered separately via POST /vault/:id/graphrag/:objectId.
     */
    #[Required('enableGraphRAG')]
    public bool $enableGraphRag;

    /**
     * Human-readable status message.
     */
    #[Required]
    public string $message;

    /**
     * ID of the vault object being processed.
     */
    #[Required('objectId')]
    public string $objectID;

    /**
     * Current ingestion status. 'stored' for file types without text extraction (no chunks/vectors created).
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Workflow run ID for tracking progress. Null for file types that skip processing.
     */
    #[Required('workflowId')]
    public ?string $workflowID;

    /**
     * `new VaultIngestResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VaultIngestResponse::with(
     *   enableGraphRag: ..., message: ..., objectID: ..., status: ..., workflowID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VaultIngestResponse)
     *   ->withEnableGraphRag(...)
     *   ->withMessage(...)
     *   ->withObjectID(...)
     *   ->withStatus(...)
     *   ->withWorkflowID(...)
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
     * @param Status|value-of<Status> $status
     */
    public static function with(
        bool $enableGraphRag,
        string $message,
        string $objectID,
        Status|string $status,
        ?string $workflowID,
    ): self {
        $self = new self;

        $self['enableGraphRag'] = $enableGraphRag;
        $self['message'] = $message;
        $self['objectID'] = $objectID;
        $self['status'] = $status;
        $self['workflowID'] = $workflowID;

        return $self;
    }

    /**
     * Always false - GraphRAG must be triggered separately via POST /vault/:id/graphrag/:objectId.
     */
    public function withEnableGraphRag(bool $enableGraphRag): self
    {
        $self = clone $this;
        $self['enableGraphRag'] = $enableGraphRag;

        return $self;
    }

    /**
     * Human-readable status message.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * ID of the vault object being processed.
     */
    public function withObjectID(string $objectID): self
    {
        $self = clone $this;
        $self['objectID'] = $objectID;

        return $self;
    }

    /**
     * Current ingestion status. 'stored' for file types without text extraction (no chunks/vectors created).
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
     * Workflow run ID for tracking progress. Null for file types that skip processing.
     */
    public function withWorkflowID(?string $workflowID): self
    {
        $self = clone $this;
        $self['workflowID'] = $workflowID;

        return $self;
    }
}
