<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Accounts;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type AccountNewResponseShape = array{
 *   id?: string|null,
 *   cachedAvailableBalance?: float|null,
 *   cachedBalance?: float|null,
 *   createdAt?: string|null,
 *   currency?: string|null,
 *   isActive?: bool|null,
 *   name?: string|null,
 *   organizationID?: string|null,
 *   type?: string|null,
 * }
 */
final class AccountNewResponse implements BaseModel
{
    /** @use SdkModel<AccountNewResponseShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?float $cachedAvailableBalance;

    #[Optional]
    public ?float $cachedBalance;

    #[Optional]
    public ?string $createdAt;

    #[Optional]
    public ?string $currency;

    #[Optional]
    public ?bool $isActive;

    #[Optional]
    public ?string $name;

    #[Optional('organizationId')]
    public ?string $organizationID;

    #[Optional]
    public ?string $type;

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
        ?string $id = null,
        ?float $cachedAvailableBalance = null,
        ?float $cachedBalance = null,
        ?string $createdAt = null,
        ?string $currency = null,
        ?bool $isActive = null,
        ?string $name = null,
        ?string $organizationID = null,
        ?string $type = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $cachedAvailableBalance && $self['cachedAvailableBalance'] = $cachedAvailableBalance;
        null !== $cachedBalance && $self['cachedBalance'] = $cachedBalance;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $currency && $self['currency'] = $currency;
        null !== $isActive && $self['isActive'] = $isActive;
        null !== $name && $self['name'] = $name;
        null !== $organizationID && $self['organizationID'] = $organizationID;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCachedAvailableBalance(
        float $cachedAvailableBalance
    ): self {
        $self = clone $this;
        $self['cachedAvailableBalance'] = $cachedAvailableBalance;

        return $self;
    }

    public function withCachedBalance(float $cachedBalance): self
    {
        $self = clone $this;
        $self['cachedBalance'] = $cachedBalance;

        return $self;
    }

    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withCurrency(string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    public function withIsActive(bool $isActive): self
    {
        $self = clone $this;
        $self['isActive'] = $isActive;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withOrganizationID(string $organizationID): self
    {
        $self = clone $this;
        $self['organizationID'] = $organizationID;

        return $self;
    }

    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
