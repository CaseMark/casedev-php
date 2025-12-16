<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Execute a deployed workflow. Supports three modes:
 * - **Fire-and-forget** (default): Returns immediately with executionId. Poll /executions/{id} for status.
 * - **Callback**: Returns immediately, POSTs result to callbackUrl when workflow completes.
 * - **Sync wait**: Blocks until workflow completes (max 5 minutes).
 *
 * @see Casedev\Services\Workflows\V1Service::execute()
 *
 * @phpstan-type V1ExecuteParamsShape = array{
 *   callbackHeaders?: mixed,
 *   callbackURL?: string,
 *   input?: mixed,
 *   timeout?: string,
 *   wait?: bool,
 * }
 */
final class V1ExecuteParams implements BaseModel
{
    /** @use SdkModel<V1ExecuteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Headers to include in callback request (e.g., Authorization).
     */
    #[Optional]
    public mixed $callbackHeaders;

    /**
     * URL to POST results when workflow completes (enables callback mode).
     */
    #[Optional('callbackUrl')]
    public ?string $callbackURL;

    /**
     * Input data to pass to the workflow.
     */
    #[Optional]
    public mixed $input;

    /**
     * Timeout for sync wait mode (e.g., '30s', '2m'). Max 5m. Default: 30s.
     */
    #[Optional]
    public ?string $timeout;

    /**
     * Wait for completion (default: false, max 5 min).
     */
    #[Optional]
    public ?bool $wait;

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
        mixed $callbackHeaders = null,
        ?string $callbackURL = null,
        mixed $input = null,
        ?string $timeout = null,
        ?bool $wait = null,
    ): self {
        $self = new self;

        null !== $callbackHeaders && $self['callbackHeaders'] = $callbackHeaders;
        null !== $callbackURL && $self['callbackURL'] = $callbackURL;
        null !== $input && $self['input'] = $input;
        null !== $timeout && $self['timeout'] = $timeout;
        null !== $wait && $self['wait'] = $wait;

        return $self;
    }

    /**
     * Headers to include in callback request (e.g., Authorization).
     */
    public function withCallbackHeaders(mixed $callbackHeaders): self
    {
        $self = clone $this;
        $self['callbackHeaders'] = $callbackHeaders;

        return $self;
    }

    /**
     * URL to POST results when workflow completes (enables callback mode).
     */
    public function withCallbackURL(string $callbackURL): self
    {
        $self = clone $this;
        $self['callbackURL'] = $callbackURL;

        return $self;
    }

    /**
     * Input data to pass to the workflow.
     */
    public function withInput(mixed $input): self
    {
        $self = clone $this;
        $self['input'] = $input;

        return $self;
    }

    /**
     * Timeout for sync wait mode (e.g., '30s', '2m'). Max 5m. Default: 30s.
     */
    public function withTimeout(string $timeout): self
    {
        $self = clone $this;
        $self['timeout'] = $timeout;

        return $self;
    }

    /**
     * Wait for completion (default: false, max 5 min).
     */
    public function withWait(bool $wait): self
    {
        $self = clone $this;
        $self['wait'] = $wait;

        return $self;
    }
}
