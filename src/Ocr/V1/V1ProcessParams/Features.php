<?php

declare(strict_types=1);

namespace Casedev\Ocr\V1\V1ProcessParams;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * OCR features to extract.
 *
 * @phpstan-type FeaturesShape = array{
 *   forms?: bool|null, layout?: bool|null, tables?: bool|null, text?: bool|null
 * }
 */
final class Features implements BaseModel
{
    /** @use SdkModel<FeaturesShape> */
    use SdkModel;

    /**
     * Detect form fields.
     */
    #[Optional]
    public ?bool $forms;

    /**
     * Preserve document layout.
     */
    #[Optional]
    public ?bool $layout;

    /**
     * Detect and extract tables.
     */
    #[Optional]
    public ?bool $tables;

    /**
     * Extract text content.
     */
    #[Optional]
    public ?bool $text;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?bool $forms = null,
        ?bool $layout = null,
        ?bool $tables = null,
        ?bool $text = null,
    ): self {
        $self = new self;

        null !== $forms && $self['forms'] = $forms;
        null !== $layout && $self['layout'] = $layout;
        null !== $tables && $self['tables'] = $tables;
        null !== $text && $self['text'] = $text;

        return $self;
    }

    /**
     * Detect form fields.
     */
    public function withForms(bool $forms): self
    {
        $self = clone $this;
        $self['forms'] = $forms;

        return $self;
    }

    /**
     * Preserve document layout.
     */
    public function withLayout(bool $layout): self
    {
        $self = clone $this;
        $self['layout'] = $layout;

        return $self;
    }

    /**
     * Detect and extract tables.
     */
    public function withTables(bool $tables): self
    {
        $self = clone $this;
        $self['tables'] = $tables;

        return $self;
    }

    /**
     * Extract text content.
     */
    public function withText(bool $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
