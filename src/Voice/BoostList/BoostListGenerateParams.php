<?php

declare(strict_types=1);

namespace CaseDev\Voice\BoostList;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Voice\BoostList\BoostListGenerateParams\Category;

/**
 * Generates a categorized word boost list from a completed transcription job. Extracts entities from the pass-1 transcript for use as `word_boost` in a second transcription pass.
 *
 * @see CaseDev\Services\Voice\BoostListService::generate()
 *
 * @phpstan-type BoostListGenerateParamsShape = array{
 *   transcriptionJobID: string,
 *   categories?: list<Category|value-of<Category>>|null,
 * }
 */
final class BoostListGenerateParams implements BaseModel
{
    /** @use SdkModel<BoostListGenerateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Completed pass-1 transcription job ID (tr_...).
     */
    #[Required('transcription_job_id')]
    public string $transcriptionJobID;

    /**
     * Optional filter for entity categories to extract.
     *
     * @var list<value-of<Category>>|null $categories
     */
    #[Optional(list: Category::class)]
    public ?array $categories;

    /**
     * `new BoostListGenerateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BoostListGenerateParams::with(transcriptionJobID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BoostListGenerateParams)->withTranscriptionJobID(...)
     * ```
     */
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
     */
    public static function with(
        string $transcriptionJobID,
        ?array $categories = null
    ): self {
        $self = new self;

        $self['transcriptionJobID'] = $transcriptionJobID;

        null !== $categories && $self['categories'] = $categories;

        return $self;
    }

    /**
     * Completed pass-1 transcription job ID (tr_...).
     */
    public function withTranscriptionJobID(string $transcriptionJobID): self
    {
        $self = clone $this;
        $self['transcriptionJobID'] = $transcriptionJobID;

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
}
