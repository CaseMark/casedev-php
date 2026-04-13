<?php

declare(strict_types=1);

namespace CaseDev\Agent\V2\Chat;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ChatNewStreamTokenResponseShape = array{
 *   token: string, expiresAt: \DateTimeInterface, streamURL: string
 * }
 */
final class ChatNewStreamTokenResponse implements BaseModel
{
    /** @use SdkModel<ChatNewStreamTokenResponseShape> */
    use SdkModel;

    #[Required]
    public string $token;

    #[Required]
    public \DateTimeInterface $expiresAt;

    #[Required('streamUrl')]
    public string $streamURL;

    /**
     * `new ChatNewStreamTokenResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ChatNewStreamTokenResponse::with(token: ..., expiresAt: ..., streamURL: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ChatNewStreamTokenResponse)
     *   ->withToken(...)
     *   ->withExpiresAt(...)
     *   ->withStreamURL(...)
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
    public static function with(
        string $token,
        \DateTimeInterface $expiresAt,
        string $streamURL
    ): self {
        $self = new self;

        $self['token'] = $token;
        $self['expiresAt'] = $expiresAt;
        $self['streamURL'] = $streamURL;

        return $self;
    }

    public function withToken(string $token): self
    {
        $self = clone $this;
        $self['token'] = $token;

        return $self;
    }

    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    public function withStreamURL(string $streamURL): self
    {
        $self = clone $this;
        $self['streamURL'] = $streamURL;

        return $self;
    }
}
