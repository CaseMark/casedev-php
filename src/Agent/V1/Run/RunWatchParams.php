<?php

declare(strict_types=1);

namespace Router\Agent\V1\Run;

use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Register a callback URL to receive notifications when the run completes. URL must use https and must not point to a private network.
 *
 * @see Router\Services\Agent\V1\RunService::watch()
 *
 * @phpstan-type RunWatchParamsShape = array{callbackURL: string}
 */
final class RunWatchParams implements BaseModel
{
    /** @use SdkModel<RunWatchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * HTTPS URL to receive completion callback.
     */
    #[Required('callbackUrl')]
    public string $callbackURL;

    /**
     * `new RunWatchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RunWatchParams::with(callbackURL: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RunWatchParams)->withCallbackURL(...)
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
    public static function with(string $callbackURL): self
    {
        $self = new self;

        $self['callbackURL'] = $callbackURL;

        return $self;
    }

    /**
     * HTTPS URL to receive completion callback.
     */
    public function withCallbackURL(string $callbackURL): self
    {
        $self = clone $this;
        $self['callbackURL'] = $callbackURL;

        return $self;
    }
}
