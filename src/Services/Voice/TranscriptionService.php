<?php

declare(strict_types=1);

namespace Casedev\Services\Voice;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Voice\TranscriptionContract;
use Casedev\Voice\Transcription\TranscriptionGetResponse;

final class TranscriptionService implements TranscriptionContract
{
    /**
     * @api
     */
    public TranscriptionRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TranscriptionRawService($client);
    }

    /**
     * @api
     *
     * Creates an asynchronous transcription job for audio files. Supports various audio formats and advanced features like speaker identification, content moderation, and automatic highlights. Returns a job ID for checking transcription status and retrieving results.
     *
     * @param string $audioURL URL of the audio file to transcribe
     * @param bool $autoHighlights Automatically extract key phrases and topics
     * @param bool $contentSafetyLabels Enable content moderation and safety labeling
     * @param bool $formatText Format text with proper capitalization
     * @param string $languageCode Language code (e.g., 'en_us', 'es', 'fr'). If not specified, language will be auto-detected
     * @param bool $languageDetection Enable automatic language detection
     * @param bool $punctuate Add punctuation to the transcript
     * @param bool $speakerLabels Enable speaker identification and labeling
     *
     * @throws APIException
     */
    public function create(
        string $audioURL,
        bool $autoHighlights = false,
        bool $contentSafetyLabels = false,
        bool $formatText = true,
        ?string $languageCode = null,
        bool $languageDetection = false,
        bool $punctuate = true,
        bool $speakerLabels = false,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        $params = [
            'audioURL' => $audioURL,
            'autoHighlights' => $autoHighlights,
            'contentSafetyLabels' => $contentSafetyLabels,
            'formatText' => $formatText,
            'languageCode' => $languageCode,
            'languageDetection' => $languageDetection,
            'punctuate' => $punctuate,
            'speakerLabels' => $speakerLabels,
        ];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve the status and result of an audio transcription job. Returns the transcription text when complete, or status information for pending jobs.
     *
     * @param string $id The transcription job ID returned from the create transcription endpoint
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): TranscriptionGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
