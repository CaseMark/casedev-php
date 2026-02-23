<?php

declare(strict_types=1);

namespace Router\Services;

use Router\Client;
use Router\ServiceContracts\VoiceContract;
use Router\Services\Voice\StreamingService;
use Router\Services\Voice\TranscriptionService;
use Router\Services\Voice\V1Service;

final class VoiceService implements VoiceContract
{
    /**
     * @api
     */
    public VoiceRawService $raw;

    /**
     * @api
     */
    public StreamingService $streaming;

    /**
     * @api
     */
    public TranscriptionService $transcription;

    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new VoiceRawService($client);
        $this->streaming = new StreamingService($client);
        $this->transcription = new TranscriptionService($client);
        $this->v1 = new V1Service($client);
    }
}
