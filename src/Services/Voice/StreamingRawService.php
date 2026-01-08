<?php

declare(strict_types=1);

namespace Casedev\Services\Voice;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Voice\StreamingRawContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
     * **Pricing:** $0.30 per minute ($18.00 per hour)
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
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
            convert: null,
        );
    }
}
