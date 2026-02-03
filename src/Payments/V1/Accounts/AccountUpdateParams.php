<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Accounts;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Update a payment account.
 *
 * @see Casedev\Services\Payments\V1\AccountsService::update()
 *
 * @phpstan-type AccountUpdateParamsShape = array{
 *   isActive?: bool|null, metadata?: mixed, name?: string|null
 * }
 */
final class AccountUpdateParams implements BaseModel
{
    /** @use SdkModel<AccountUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional('is_active')]
    public ?bool $isActive;

    #[Optional]
    public mixed $metadata;

    #[Optional]
    public ?string $name;

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
        ?bool $isActive = null,
        mixed $metadata = null,
        ?string $name = null
    ): self {
        $self = new self;

        null !== $isActive && $self['isActive'] = $isActive;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    public function withIsActive(bool $isActive): self
    {
        $self = clone $this;
        $self['isActive'] = $isActive;

        return $self;
    }

    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
