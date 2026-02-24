<?php

declare(strict_types=1);

namespace CaseDev\Services;

use CaseDev\Client;
use CaseDev\ServiceContracts\VoiceContract;
use CaseDev\Services\Voice\StreamingService;
use CaseDev\Services\Voice\TranscriptionService;
use CaseDev\Services\Voice\V1Service;

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
