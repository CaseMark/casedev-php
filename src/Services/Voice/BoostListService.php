<?php

declare(strict_types=1);

namespace CaseDev\Services\Voice;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Voice\BoostListContract;
use CaseDev\Voice\BoostList\BoostListExtractParams\Category;
use CaseDev\Voice\BoostList\BoostListExtractResponse;
use CaseDev\Voice\BoostList\BoostListGenerateResponse;

/**
 * Audio transcription and text-to-speech.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class BoostListService implements BoostListContract
{
    /**
     * @api
     */
    public BoostListRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BoostListRawService($client);
    }

    /**
     * @api
     *
     * Extracts a categorized word boost list from vault documents or raw text using LLM entity extraction. The resulting list can be passed as `word_boost` to the transcription endpoint for improved accuracy.
     *
     * @param list<Category|value-of<Category>> $categories Optional filter for entity categories to extract
     * @param list<string> $objectIDs Object IDs of documents to extract entities from (PDFs, text files)
     * @param string $text Raw text input for entity extraction (alternative to vault documents)
     * @param string $vaultID Vault ID containing the source documents (use with object_ids)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function extract(
        ?array $categories = null,
        ?array $objectIDs = null,
        ?string $text = null,
        ?string $vaultID = null,
        RequestOptions|array|null $requestOptions = null,
    ): BoostListExtractResponse {
        $params = Util::removeNulls(
            [
                'categories' => $categories,
                'objectIDs' => $objectIDs,
                'text' => $text,
                'vaultID' => $vaultID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->extract(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Generates a categorized word boost list from a completed transcription job. Extracts entities from the pass-1 transcript for use as `word_boost` in a second transcription pass.
     *
     * @param string $transcriptionJobID Completed pass-1 transcription job ID (tr_...)
     * @param list<\CaseDev\Voice\BoostList\BoostListGenerateParams\Category|value-of<\CaseDev\Voice\BoostList\BoostListGenerateParams\Category>> $categories Optional filter for entity categories to extract
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function generate(
        string $transcriptionJobID,
        ?array $categories = null,
        RequestOptions|array|null $requestOptions = null,
    ): BoostListGenerateResponse {
        $params = Util::removeNulls(
            ['transcriptionJobID' => $transcriptionJobID, 'categories' => $categories]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->generate(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
