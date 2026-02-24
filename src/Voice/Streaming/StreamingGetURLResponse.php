<?php

declare(strict_types=1);

namespace CaseDev\Voice\Streaming;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Voice\Streaming\StreamingGetURLResponse\AudioFormat;
use CaseDev\Voice\Streaming\StreamingGetURLResponse\Pricing;

/**
 * @phpstan-import-type AudioFormatShape from \CaseDev\Voice\Streaming\StreamingGetURLResponse\AudioFormat
 * @phpstan-import-type PricingShape from \CaseDev\Voice\Streaming\StreamingGetURLResponse\Pricing
 *
 * @phpstan-type StreamingGetURLResponseShape = array{
 *   audioFormat?: null|AudioFormat|AudioFormatShape,
 *   connectURL?: string|null,
 *   pricing?: null|Pricing|PricingShape,
 *   protocol?: string|null,
 *   url?: string|null,
 * }
 */
final class StreamingGetURLResponse implements BaseModel
{
    /** @use SdkModel<StreamingGetURLResponseShape> */
    use SdkModel;

    #[Optional('audio_format')]
    public ?AudioFormat $audioFormat;

    /**
     * Complete WebSocket URL with authentication token.
     */
    #[Optional('connect_url')]
    public ?string $connectURL;

    #[Optional]
    public ?Pricing $pricing;

    /**
     * Connection protocol.
     */
    #[Optional]
    public ?string $protocol;

    /**
     * Base WebSocket URL for streaming transcription.
     */
    #[Optional]
    public ?string $url;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param AudioFormat|AudioFormatShape|null $audioFormat
     * @param Pricing|PricingShape|null $pricing
     */
    public static function with(
        AudioFormat|array|null $audioFormat = null,
        ?string $connectURL = null,
        Pricing|array|null $pricing = null,
        ?string $protocol = null,
        ?string $url = null,
    ): self {
        $self = new self;

        null !== $audioFormat && $self['audioFormat'] = $audioFormat;
        null !== $connectURL && $self['connectURL'] = $connectURL;
        null !== $pricing && $self['pricing'] = $pricing;
        null !== $protocol && $self['protocol'] = $protocol;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * @param AudioFormat|AudioFormatShape $audioFormat
     */
    public function withAudioFormat(AudioFormat|array $audioFormat): self
    {
        $self = clone $this;
        $self['audioFormat'] = $audioFormat;

        return $self;
    }

    /**
     * Complete WebSocket URL with authentication token.
     */
    public function withConnectURL(string $connectURL): self
    {
        $self = clone $this;
        $self['connectURL'] = $connectURL;

        return $self;
    }

    /**
     * @param Pricing|PricingShape $pricing
     */
    public function withPricing(Pricing|array $pricing): self
    {
        $self = clone $this;
        $self['pricing'] = $pricing;

        return $self;
    }

    /**
     * Connection protocol.
     */
    public function withProtocol(string $protocol): self
    {
        $self = clone $this;
        $self['protocol'] = $protocol;

        return $self;
    }

    /**
     * Base WebSocket URL for streaming transcription.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
