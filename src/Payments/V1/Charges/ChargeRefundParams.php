<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Charges;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Refund a succeeded charge (full or partial).
 *
 * @see Casedev\Services\Payments\V1\ChargesService::refund()
 *
 * @phpstan-type ChargeRefundParamsShape = array{
 *   amount?: int|null, reason?: string|null
 * }
 */
final class ChargeRefundParams implements BaseModel
{
    /** @use SdkModel<ChargeRefundParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Amount to refund in cents. If not provided, full refund.
     */
    #[Optional]
    public ?int $amount;

    /**
     * Reason for refund.
     */
    #[Optional]
    public ?string $reason;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?int $amount = null, ?string $reason = null): self
    {
        $self = new self;

        null !== $amount && $self['amount'] = $amount;
        null !== $reason && $self['reason'] = $reason;

        return $self;
    }

    /**
     * Amount to refund in cents. If not provided, full refund.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * Reason for refund.
     */
    public function withReason(string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}
