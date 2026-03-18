<?php

declare(strict_types=1);

namespace CaseDev\Mail\V1\Inboxes;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Set the sender allowlist and send/reply/read access rules for an inbox owned by the authenticated organization.
 *
 * @see CaseDev\Services\Mail\V1\InboxesService::setPolicy()
 *
 * @phpstan-type InboxSetPolicyParamsShape = array{
 *   allowedSenderPatterns?: list<string>|null,
 *   enforceSenderAllowlist?: bool|null,
 *   readAccessRules?: list<string>|null,
 *   replyAccessRules?: list<string>|null,
 *   sendAccessRules?: list<string>|null,
 * }
 */
final class InboxSetPolicyParams implements BaseModel
{
    /** @use SdkModel<InboxSetPolicyParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Exact emails, @domain rules, or *.
     *
     * @var list<string>|null $allowedSenderPatterns
     */
    #[Optional(list: 'string')]
    public ?array $allowedSenderPatterns;

    #[Optional]
    public ?bool $enforceSenderAllowlist;

    /**
     * Rules like organization, operator, user:<id>, api_key, api_key:<id>, clerk_session, or *.
     *
     * @var list<string>|null $readAccessRules
     */
    #[Optional(list: 'string')]
    public ?array $readAccessRules;

    /**
     * Rules like organization, operator, user:<id>, api_key, api_key:<id>, clerk_session, or *.
     *
     * @var list<string>|null $replyAccessRules
     */
    #[Optional(list: 'string')]
    public ?array $replyAccessRules;

    /**
     * Rules like organization, user:<id>, api_key, api_key:<id>, clerk_session, or *.
     *
     * @var list<string>|null $sendAccessRules
     */
    #[Optional(list: 'string')]
    public ?array $sendAccessRules;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $allowedSenderPatterns
     * @param list<string>|null $readAccessRules
     * @param list<string>|null $replyAccessRules
     * @param list<string>|null $sendAccessRules
     */
    public static function with(
        ?array $allowedSenderPatterns = null,
        ?bool $enforceSenderAllowlist = null,
        ?array $readAccessRules = null,
        ?array $replyAccessRules = null,
        ?array $sendAccessRules = null,
    ): self {
        $self = new self;

        null !== $allowedSenderPatterns && $self['allowedSenderPatterns'] = $allowedSenderPatterns;
        null !== $enforceSenderAllowlist && $self['enforceSenderAllowlist'] = $enforceSenderAllowlist;
        null !== $readAccessRules && $self['readAccessRules'] = $readAccessRules;
        null !== $replyAccessRules && $self['replyAccessRules'] = $replyAccessRules;
        null !== $sendAccessRules && $self['sendAccessRules'] = $sendAccessRules;

        return $self;
    }

    /**
     * Exact emails, @domain rules, or *.
     *
     * @param list<string> $allowedSenderPatterns
     */
    public function withAllowedSenderPatterns(
        array $allowedSenderPatterns
    ): self {
        $self = clone $this;
        $self['allowedSenderPatterns'] = $allowedSenderPatterns;

        return $self;
    }

    public function withEnforceSenderAllowlist(
        bool $enforceSenderAllowlist
    ): self {
        $self = clone $this;
        $self['enforceSenderAllowlist'] = $enforceSenderAllowlist;

        return $self;
    }

    /**
     * Rules like organization, operator, user:<id>, api_key, api_key:<id>, clerk_session, or *.
     *
     * @param list<string> $readAccessRules
     */
    public function withReadAccessRules(array $readAccessRules): self
    {
        $self = clone $this;
        $self['readAccessRules'] = $readAccessRules;

        return $self;
    }

    /**
     * Rules like organization, operator, user:<id>, api_key, api_key:<id>, clerk_session, or *.
     *
     * @param list<string> $replyAccessRules
     */
    public function withReplyAccessRules(array $replyAccessRules): self
    {
        $self = clone $this;
        $self['replyAccessRules'] = $replyAccessRules;

        return $self;
    }

    /**
     * Rules like organization, user:<id>, api_key, api_key:<id>, clerk_session, or *.
     *
     * @param list<string> $sendAccessRules
     */
    public function withSendAccessRules(array $sendAccessRules): self
    {
        $self = clone $this;
        $self['sendAccessRules'] = $sendAccessRules;

        return $self;
    }
}
