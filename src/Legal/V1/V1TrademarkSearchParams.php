<?php

declare(strict_types=1);

namespace Router\Legal\V1;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Look up trademark status and details from the USPTO Trademark Status & Document Retrieval (TSDR) system. Supports lookup by serial number or registration number. Returns mark text, status, owner, goods/services, Nice classification, filing/registration dates, and more.
 *
 * @see Router\Services\Legal\V1Service::trademarkSearch()
 *
 * @phpstan-type V1TrademarkSearchParamsShape = array{
 *   registrationNumber?: string|null, serialNumber?: string|null
 * }
 */
final class V1TrademarkSearchParams implements BaseModel
{
    /** @use SdkModel<V1TrademarkSearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * USPTO registration number (e.g. "6123456"). Provide either serialNumber or registrationNumber.
     */
    #[Optional]
    public ?string $registrationNumber;

    /**
     * USPTO serial number (e.g. "97123456"). Provide either serialNumber or registrationNumber.
     */
    #[Optional]
    public ?string $serialNumber;

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
        ?string $registrationNumber = null,
        ?string $serialNumber = null
    ): self {
        $self = new self;

        null !== $registrationNumber && $self['registrationNumber'] = $registrationNumber;
        null !== $serialNumber && $self['serialNumber'] = $serialNumber;

        return $self;
    }

    /**
     * USPTO registration number (e.g. "6123456"). Provide either serialNumber or registrationNumber.
     */
    public function withRegistrationNumber(string $registrationNumber): self
    {
        $self = clone $this;
        $self['registrationNumber'] = $registrationNumber;

        return $self;
    }

    /**
     * USPTO serial number (e.g. "97123456"). Provide either serialNumber or registrationNumber.
     */
    public function withSerialNumber(string $serialNumber): self
    {
        $self = clone $this;
        $self['serialNumber'] = $serialNumber;

        return $self;
    }
}
