<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Voice;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Voice\Transcription\TranscriptionGetResponse;

interface TranscriptionContract
{
    /**
     * @api
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
    ): mixed;

    /**
     * @api
     *
     * @param string $id The transcription job ID returned from the create transcription endpoint
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): TranscriptionGetResponse;
}
