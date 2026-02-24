<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type RunWatchResponseShape = array{
 *   callbackURL?: string|null, ok?: bool|null
 * }
 */
final class RunWatchResponse implements BaseModel
{
    /** @use SdkModel<RunWatchResponseShape> */
    use SdkModel;

    #[Optional('callbackUrl')]
    public ?string $callbackURL;

    #[Optional]
    public ?bool $ok;

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
        ?string $callbackURL = null,
        ?bool $ok = null
    ): self {
        $self = new self;

        null !== $callbackURL && $self['callbackURL'] = $callbackURL;
        null !== $ok && $self['ok'] = $ok;

        return $self;
    }

    public function withCallbackURL(string $callbackURL): self
    {
        $self = clone $this;
        $self['callbackURL'] = $callbackURL;

        return $self;
    }

    public function withOk(bool $ok): self
    {
        $self = clone $this;
        $self['ok'] = $ok;

        return $self;
    }
}
