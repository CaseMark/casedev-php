<?php

declare(strict_types=1);

namespace CaseDev\Services\Voice;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Voice\StreamingRawContract;
use CaseDev\Voice\Streaming\StreamingGetURLResponse;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class StreamingRawService implements StreamingRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns the WebSocket URL and connection details for real-time audio transcription. The returned URL can be used to establish a WebSocket connection for streaming audio data and receiving transcribed text in real-time.
     *
     * **Audio Requirements:**
     * - Sample Rate: 16kHz
     * - Encoding: PCM 16-bit little-endian
     * - Channels: Mono (1 channel)
     *
     * **Pricing:** $0.01 per minute ($0.60 per hour)
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<StreamingGetURLResponse>
     *
     * @throws APIException
     */
    public function getURL(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'voice/streaming/url',
            options: $requestOptions,
            convert: StreamingGetURLResponse::class,
        );
    }
}
