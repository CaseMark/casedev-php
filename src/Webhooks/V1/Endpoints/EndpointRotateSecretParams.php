<?php

declare(strict_types=1);

namespace CaseDev\Webhooks\V1\Endpoints;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Generates a new signing secret for the endpoint. The previous secret remains valid until `previousSecretExpiresInSec` elapses (default 24h, max 30 days). During the grace window deliveries are signed with both secrets so receivers can migrate without downtime. Returns the new secret — this is the only time it is shown in plaintext.
 *
 * @see CaseDev\Services\Webhooks\V1\EndpointsService::rotateSecret()
 *
 * @phpstan-type EndpointRotateSecretParamsShape = array{
 *   previousSecretExpiresInSec?: int|null
 * }
 */
final class EndpointRotateSecretParams implements BaseModel
{
    /** @use SdkModel<EndpointRotateSecretParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * How long (seconds) the old secret continues to be accepted. 0 invalidates immediately. Default: 86400 (24h).
     */
    #[Optional]
    public ?int $previousSecretExpiresInSec;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?int $previousSecretExpiresInSec = null): self
    {
        $self = new self;

        null !== $previousSecretExpiresInSec && $self['previousSecretExpiresInSec'] = $previousSecretExpiresInSec;

        return $self;
    }

    /**
     * How long (seconds) the old secret continues to be accepted. 0 invalidates immediately. Default: 86400 (24h).
     */
    public function withPreviousSecretExpiresInSec(
        int $previousSecretExpiresInSec
    ): self {
        $self = clone $this;
        $self['previousSecretExpiresInSec'] = $previousSecretExpiresInSec;

        return $self;
    }
}
