<?php

declare(strict_types=1);

namespace CaseDev\Voice\BoostList;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Voice\BoostList\BoostListExtractParams\Category;

/**
 * Extracts a categorized word boost list from vault documents or raw text using LLM entity extraction. The resulting list can be passed as `word_boost` to the transcription endpoint for improved accuracy.
 *
 * @see CaseDev\Services\Voice\BoostListService::extract()
 *
 * @phpstan-type BoostListExtractParamsShape = array{
 *   categories?: list<Category|value-of<Category>>|null,
 *   objectIDs?: list<string>|null,
 *   text?: string|null,
 *   vaultID?: string|null,
 * }
 */
final class BoostListExtractParams implements BaseModel
{
    /** @use SdkModel<BoostListExtractParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Optional filter for entity categories to extract.
     *
     * @var list<value-of<Category>>|null $categories
     */
    #[Optional(list: Category::class)]
    public ?array $categories;

    /**
     * Object IDs of documents to extract entities from (PDFs, text files).
     *
     * @var list<string>|null $objectIDs
     */
    #[Optional('object_ids', list: 'string')]
    public ?array $objectIDs;

    /**
     * Raw text input for entity extraction (alternative to vault documents).
     */
    #[Optional]
    public ?string $text;

    /**
     * Vault ID containing the source documents (use with object_ids).
     */
    #[Optional('vault_id')]
    public ?string $vaultID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Category|value-of<Category>>|null $categories
     * @param list<string>|null $objectIDs
     */
    public static function with(
        ?array $categories = null,
        ?array $objectIDs = null,
        ?string $text = null,
        ?string $vaultID = null,
    ): self {
        $self = new self;

        null !== $categories && $self['categories'] = $categories;
        null !== $objectIDs && $self['objectIDs'] = $objectIDs;
        null !== $text && $self['text'] = $text;
        null !== $vaultID && $self['vaultID'] = $vaultID;

        return $self;
    }

    /**
     * Optional filter for entity categories to extract.
     *
     * @param list<Category|value-of<Category>> $categories
     */
    public function withCategories(array $categories): self
    {
        $self = clone $this;
        $self['categories'] = $categories;

        return $self;
    }

    /**
     * Object IDs of documents to extract entities from (PDFs, text files).
     *
     * @param list<string> $objectIDs
     */
    public function withObjectIDs(array $objectIDs): self
    {
        $self = clone $this;
        $self['objectIDs'] = $objectIDs;

        return $self;
    }

    /**
     * Raw text input for entity extraction (alternative to vault documents).
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    /**
     * Vault ID containing the source documents (use with object_ids).
     */
    public function withVaultID(string $vaultID): self
    {
        $self = clone $this;
        $self['vaultID'] = $vaultID;

        return $self;
    }
}
