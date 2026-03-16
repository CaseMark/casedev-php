<?php

declare(strict_types=1);

namespace CaseDev\Mail\V1\Inboxes;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Reply to a message in an inbox owned by the authenticated organization.
 *
 * @see CaseDev\Services\Mail\V1\InboxesService::reply()
 *
 * @phpstan-type InboxReplyParamsShape = array{inboxID: string}
 */
final class InboxReplyParams implements BaseModel
{
    /** @use SdkModel<InboxReplyParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $inboxID;

    /**
     * `new InboxReplyParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboxReplyParams::with(inboxID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboxReplyParams)->withInboxID(...)
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
    public static function with(string $inboxID): self
    {
        $self = new self;

        $self['inboxID'] = $inboxID;

        return $self;
    }

    public function withInboxID(string $inboxID): self
    {
        $self = clone $this;
        $self['inboxID'] = $inboxID;

        return $self;
    }
}
