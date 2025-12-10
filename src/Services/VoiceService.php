<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\ServiceContracts\VoiceContract;
use Casedev\Services\Voice\StreamingService;
use Casedev\Services\Voice\TranscriptionService;
use Casedev\Services\Voice\V1Service;

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
