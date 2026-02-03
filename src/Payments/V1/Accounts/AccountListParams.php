<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Accounts;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * List all payment accounts for the organization.
 *
 * @see Casedev\Services\Payments\V1\AccountsService::list()
 *
 * @phpstan-type AccountListParamsShape = array{
 *   limit?: int|null,
 *   matterID?: string|null,
 *   offset?: int|null,
 *   parentAccountID?: string|null,
 *   type?: string|null,
 * }
 */
final class AccountListParams implements BaseModel
{
    /** @use SdkModel<AccountListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Max results to return.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Filter by matter ID.
     */
    #[Optional]
    public ?string $matterID;

    /**
     * Offset for pagination.
     */
    #[Optional]
    public ?int $offset;

    /**
     * Filter by parent account.
     */
    #[Optional]
    public ?string $parentAccountID;

    /**
     * Filter by account type.
     */
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
        ?int $limit = null,
        ?string $matterID = null,
        ?int $offset = null,
        ?string $parentAccountID = null,
        ?string $type = null,
    ): self {
        $self = new self;

        null !== $limit && $self['limit'] = $limit;
        null !== $matterID && $self['matterID'] = $matterID;
        null !== $offset && $self['offset'] = $offset;
        null !== $parentAccountID && $self['parentAccountID'] = $parentAccountID;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Max results to return.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Filter by matter ID.
     */
    public function withMatterID(string $matterID): self
    {
        $self = clone $this;
        $self['matterID'] = $matterID;

        return $self;
    }

    /**
     * Offset for pagination.
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }

    /**
     * Filter by parent account.
     */
    public function withParentAccountID(string $parentAccountID): self
    {
        $self = clone $this;
        $self['parentAccountID'] = $parentAccountID;

        return $self;
    }

    /**
     * Filter by account type.
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
