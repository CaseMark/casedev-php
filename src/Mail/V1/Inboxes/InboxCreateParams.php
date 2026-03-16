<?php

declare(strict_types=1);

namespace CaseDev\Mail\V1\Inboxes;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Create an inbox owned by the authenticated organization.
 *
 * @see CaseDev\Services\Mail\V1\InboxesService::create()
 *
 * @phpstan-type InboxCreateParamsShape = array{
 *   address?: string|null, displayName?: string|null
 * }
 */
final class InboxCreateParams implements BaseModel
{
    /** @use SdkModel<InboxCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?string $address;

    #[Optional]
    public ?string $displayName;

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
        ?string $address = null,
        ?string $displayName = null
    ): self {
        $self = new self;

        null !== $address && $self['address'] = $address;
        null !== $displayName && $self['displayName'] = $displayName;

        return $self;
    }

    public function withAddress(string $address): self
    {
        $self = clone $this;
        $self['address'] = $address;

        return $self;
    }

    public function withDisplayName(string $displayName): self
    {
        $self = clone $this;
        $self['displayName'] = $displayName;

        return $self;
    }
}
