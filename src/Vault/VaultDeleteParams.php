<?php

declare(strict_types=1);

namespace Router\Vault;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Permanently deletes a vault and all its contents including documents, vectors, graph data, and S3 buckets. This operation cannot be undone. For large vaults, use the async=true query parameter to queue deletion in the background.
 *
 * @see Router\Services\VaultService::delete()
 *
 * @phpstan-type VaultDeleteParamsShape = array{async?: bool|null}
 */
final class VaultDeleteParams implements BaseModel
{
    /** @use SdkModel<VaultDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * If true and vault has many objects, queue deletion in background and return immediately.
     */
    #[Optional]
    public ?bool $async;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?bool $async = null): self
    {
        $self = new self;

        null !== $async && $self['async'] = $async;

        return $self;
    }

    /**
     * If true and vault has many objects, queue deletion in background and return immediately.
     */
    public function withAsync(bool $async): self
    {
        $self = clone $this;
        $self['async'] = $async;

        return $self;
    }
}
