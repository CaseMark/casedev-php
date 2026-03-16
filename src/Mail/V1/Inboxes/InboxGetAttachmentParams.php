<?php

declare(strict_types=1);

namespace CaseDev\Mail\V1\Inboxes;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Get attachment metadata for a message in an inbox owned by the authenticated organization.
 *
 * @see CaseDev\Services\Mail\V1\InboxesService::getAttachment()
 *
 * @phpstan-type InboxGetAttachmentParamsShape = array{
 *   inboxID: string, messageID: string
 * }
 */
final class InboxGetAttachmentParams implements BaseModel
{
    /** @use SdkModel<InboxGetAttachmentParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $inboxID;

    #[Required]
    public string $messageID;

    /**
     * `new InboxGetAttachmentParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboxGetAttachmentParams::with(inboxID: ..., messageID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboxGetAttachmentParams)->withInboxID(...)->withMessageID(...)
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
    public static function with(string $inboxID, string $messageID): self
    {
        $self = new self;

        $self['inboxID'] = $inboxID;
        $self['messageID'] = $messageID;

        return $self;
    }

    public function withInboxID(string $inboxID): self
    {
        $self = clone $this;
        $self['inboxID'] = $inboxID;

        return $self;
    }

    public function withMessageID(string $messageID): self
    {
        $self = clone $this;
        $self['messageID'] = $messageID;

        return $self;
    }
}
