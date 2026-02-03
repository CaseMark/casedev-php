<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Holds;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Record an approval for a hold release condition.
 *
 * @see Casedev\Services\Payments\V1\HoldsService::approve()
 *
 * @phpstan-type HoldApproveParamsShape = array{approverID?: string|null}
 */
final class HoldApproveParams implements BaseModel
{
    /** @use SdkModel<HoldApproveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * ID of the approver (party or user).
     */
    #[Optional('approver_id')]
    public ?string $approverID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $approverID = null): self
    {
        $self = new self;

        null !== $approverID && $self['approverID'] = $approverID;

        return $self;
    }

    /**
     * ID of the approver (party or user).
     */
    public function withApproverID(string $approverID): self
    {
        $self = clone $this;
        $self['approverID'] = $approverID;

        return $self;
    }
}
