<?php

declare(strict_types=1);

namespace Casedev\Vault;

use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Vault\VaultIngestResponse\Status;

/**
 * @phpstan-type VaultIngestResponseShape = array{
 *   enableGraphRag: bool,
 *   message: string,
 *   objectID: string,
 *   status: value-of<Status>,
 *   workflowID: string,
 * }
 */
final class VaultIngestResponse implements BaseModel
{
    /** @use SdkModel<VaultIngestResponseShape> */
    use SdkModel;

    /**
     * Whether GraphRAG is enabled for this vault.
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
     * Current ingestion status.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Workflow run ID for tracking progress.
     */
    #[Required('workflowId')]
    public string $workflowID;

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
        string $workflowID,
    ): self {
        $obj = new self;

        $obj['enableGraphRag'] = $enableGraphRag;
        $obj['message'] = $message;
        $obj['objectID'] = $objectID;
        $obj['status'] = $status;
        $obj['workflowID'] = $workflowID;

        return $obj;
    }

    /**
     * Whether GraphRAG is enabled for this vault.
     */
    public function withEnableGraphRag(bool $enableGraphRag): self
    {
        $obj = clone $this;
        $obj['enableGraphRag'] = $enableGraphRag;

        return $obj;
    }

    /**
     * Human-readable status message.
     */
    public function withMessage(string $message): self
    {
        $obj = clone $this;
        $obj['message'] = $message;

        return $obj;
    }

    /**
     * ID of the vault object being processed.
     */
    public function withObjectID(string $objectID): self
    {
        $obj = clone $this;
        $obj['objectID'] = $objectID;

        return $obj;
    }

    /**
     * Current ingestion status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * Workflow run ID for tracking progress.
     */
    public function withWorkflowID(string $workflowID): self
    {
        $obj = clone $this;
        $obj['workflowID'] = $workflowID;

        return $obj;
    }
}
