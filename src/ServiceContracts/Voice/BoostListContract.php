<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Voice;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Voice\BoostList\BoostListExtractParams\Category;
use CaseDev\Voice\BoostList\BoostListExtractResponse;
use CaseDev\Voice\BoostList\BoostListGenerateResponse;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface BoostListContract
{
    /**
     * @api
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
    ): BoostListExtractResponse;

    /**
     * @api
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
    ): BoostListGenerateResponse;
}
