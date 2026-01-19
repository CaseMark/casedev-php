<?php

declare(strict_types=1);

namespace Casedev\Services\Voice;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Voice\TranscriptionContract;
use Casedev\Voice\Transcription\TranscriptionCreateParams\BoostParam;
use Casedev\Voice\Transcription\TranscriptionCreateParams\Format;
use Casedev\Voice\Transcription\TranscriptionGetResponse;
use Casedev\Voice\Transcription\TranscriptionNewResponse;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
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
     * Creates an asynchronous transcription job for audio files. Supports two modes:
     *
     * **Vault-based (recommended)**: Pass `vault_id` and `object_id` to transcribe audio from your vault. The transcript will automatically be saved back to the vault when complete.
     *
     * **Direct URL (legacy)**: Pass `audio_url` for direct transcription without automatic storage.
     *
     * @param string $audioURL URL of the audio file to transcribe (legacy mode, no auto-storage)
     * @param bool $autoHighlights Automatically extract key phrases and topics
     * @param BoostParam|value-of<BoostParam> $boostParam How much to boost custom vocabulary
     * @param bool $contentSafetyLabels Enable content moderation and safety labeling
     * @param Format|value-of<Format> $format Output format for the transcript when using vault mode
     * @param bool $formatText Format text with proper capitalization
     * @param string $languageCode Language code (e.g., 'en_us', 'es', 'fr'). If not specified, language will be auto-detected
     * @param bool $languageDetection Enable automatic language detection
     * @param string $objectID Object ID of the audio file in the vault (use with vault_id)
     * @param bool $punctuate Add punctuation to the transcript
     * @param bool $speakerLabels Enable speaker identification and labeling
     * @param int $speakersExpected Expected number of speakers (improves accuracy when known)
     * @param string $vaultID Vault ID containing the audio file (use with object_id)
     * @param list<string> $wordBoost Custom vocabulary words to boost (e.g., legal terms)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?string $audioURL = null,
        bool $autoHighlights = false,
        BoostParam|string|null $boostParam = null,
        bool $contentSafetyLabels = false,
        Format|string $format = 'json',
        bool $formatText = true,
        ?string $languageCode = null,
        bool $languageDetection = false,
        ?string $objectID = null,
        bool $punctuate = true,
        bool $speakerLabels = false,
        ?int $speakersExpected = null,
        ?string $vaultID = null,
        ?array $wordBoost = null,
        RequestOptions|array|null $requestOptions = null,
    ): TranscriptionNewResponse {
        $params = Util::removeNulls(
            [
                'audioURL' => $audioURL,
                'autoHighlights' => $autoHighlights,
                'boostParam' => $boostParam,
                'contentSafetyLabels' => $contentSafetyLabels,
                'format' => $format,
                'formatText' => $formatText,
                'languageCode' => $languageCode,
                'languageDetection' => $languageDetection,
                'objectID' => $objectID,
                'punctuate' => $punctuate,
                'speakerLabels' => $speakerLabels,
                'speakersExpected' => $speakersExpected,
                'vaultID' => $vaultID,
                'wordBoost' => $wordBoost,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve the status and result of an audio transcription job. For vault-based jobs, returns status and result_object_id when complete. For legacy direct URL jobs, returns the full transcription data.
     *
     * @param string $id The transcription job ID (tr_xxx for vault-based, or AssemblyAI ID for legacy)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): TranscriptionGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
