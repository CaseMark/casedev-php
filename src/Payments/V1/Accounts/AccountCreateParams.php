<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Accounts;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Payments\V1\Accounts\AccountCreateParams\Type;

/**
 * Create a new payment account (trust, operating, escrow, client sub-account, etc.).
 *
 * @see Casedev\Services\Payments\V1\AccountsService::create()
 *
 * @phpstan-type AccountCreateParamsShape = array{
 *   name: string,
 *   type: Type|value-of<Type>,
 *   currency?: string|null,
 *   matterID?: string|null,
 *   metadata?: mixed,
 *   parentAccountID?: string|null,
 * }
 */
final class AccountCreateParams implements BaseModel
{
    /** @use SdkModel<AccountCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Account name.
     */
    #[Required]
    public string $name;

    /**
     * Account type.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Currency code.
     */
    #[Optional]
    public ?string $currency;

    /**
     * Associated matter ID.
     */
    #[Optional('matter_id')]
    public ?string $matterID;

    /**
     * Additional metadata.
     */
    #[Optional]
    public mixed $metadata;

    /**
     * Parent account ID for sub-accounts.
     */
    #[Optional('parent_account_id')]
    public ?string $parentAccountID;

    /**
     * `new AccountCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountCreateParams::with(name: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountCreateParams)->withName(...)->withType(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $name,
        Type|string $type,
        ?string $currency = null,
        ?string $matterID = null,
        mixed $metadata = null,
        ?string $parentAccountID = null,
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['type'] = $type;

        null !== $currency && $self['currency'] = $currency;
        null !== $matterID && $self['matterID'] = $matterID;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $parentAccountID && $self['parentAccountID'] = $parentAccountID;

        return $self;
    }

    /**
     * Account name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Account type.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Currency code.
     */
    public function withCurrency(string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Associated matter ID.
     */
    public function withMatterID(string $matterID): self
    {
        $self = clone $this;
        $self['matterID'] = $matterID;

        return $self;
    }

    /**
     * Additional metadata.
     */
    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Parent account ID for sub-accounts.
     */
    public function withParentAccountID(string $parentAccountID): self
    {
        $self = clone $this;
        $self['parentAccountID'] = $parentAccountID;

        return $self;
    }
}
