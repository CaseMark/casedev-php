<?php

declare(strict_types=1);

namespace Casedev\Vault;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkResponse;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Core\Conversion\Contracts\ResponseConverter;
use Casedev\Vault\VaultIngestResponse\Status;

/**
 * @phpstan-type VaultIngestResponseShape = array{
 *   enableGraphRAG: bool,
 *   message: string,
 *   objectId: string,
 *   status: value-of<Status>,
 *   workflowId: string,
 * }
 */
final class VaultIngestResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<VaultIngestResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Whether GraphRAG is enabled for this vault.
     */
    #[Api]
    public bool $enableGraphRAG;

    /**
     * Human-readable status message.
     */
    #[Api]
    public string $message;

    /**
     * ID of the vault object being processed.
     */
    #[Api]
    public string $objectId;

    /**
     * Current ingestion status.
     *
     * @var value-of<Status> $status
     */
    #[Api(enum: Status::class)]
    public string $status;

    /**
     * Workflow run ID for tracking progress.
     */
    #[Api]
    public string $workflowId;

    /**
     * `new VaultIngestResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VaultIngestResponse::with(
     *   enableGraphRAG: ..., message: ..., objectId: ..., status: ..., workflowId: ...
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
        bool $enableGraphRAG,
        string $message,
        string $objectId,
        Status|string $status,
        string $workflowId,
    ): self {
        $obj = new self;

        $obj->enableGraphRAG = $enableGraphRAG;
        $obj->message = $message;
        $obj->objectId = $objectId;
        $obj['status'] = $status;
        $obj->workflowId = $workflowId;

        return $obj;
    }

    /**
     * Whether GraphRAG is enabled for this vault.
     */
    public function withEnableGraphRag(bool $enableGraphRag): self
    {
        $obj = clone $this;
        $obj->enableGraphRAG = $enableGraphRag;

        return $obj;
    }

    /**
     * Human-readable status message.
     */
    public function withMessage(string $message): self
    {
        $obj = clone $this;
        $obj->message = $message;

        return $obj;
    }

    /**
     * ID of the vault object being processed.
     */
    public function withObjectID(string $objectID): self
    {
        $obj = clone $this;
        $obj->objectId = $objectID;

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
        $obj->workflowId = $workflowID;

        return $obj;
    }
}
