<?php

declare(strict_types=1);

namespace Casedev\Services\Voice;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Voice\StreamingContract;
use Casedev\Voice\Streaming\StreamingGetURLResponse;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class StreamingService implements StreamingContract
{
    /**
     * @api
     */
    public StreamingRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new StreamingRawService($client);
    }

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
     * @throws APIException
     */
    public function getURL(
        RequestOptions|array|null $requestOptions = null
    ): StreamingGetURLResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getURL(requestOptions: $requestOptions);

        return $response->parse();
    }
}
