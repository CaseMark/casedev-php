<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\Shares;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Revoke a matter share and its linked vault share.
 *
 * @see CaseDev\Services\Matters\V1\SharesService::delete()
 *
 * @phpstan-type ShareDeleteParamsShape = array{id: string}
 */
final class ShareDeleteParams implements BaseModel
{
    /** @use SdkModel<ShareDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new ShareDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ShareDeleteParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ShareDeleteParams)->withID(...)
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
    public static function with(string $id): self
    {
        $self = new self;

        $self['id'] = $id;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
