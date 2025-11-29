<?php

declare(strict_types=1);

namespace Casedev\Ocr\V1\V1ProcessParams;

use Casedev\Core\Attributes\Api;
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
    #[Api(optional: true)]
    public ?bool $forms;

    /**
     * Preserve document layout.
     */
    #[Api(optional: true)]
    public ?bool $layout;

    /**
     * Detect and extract tables.
     */
    #[Api(optional: true)]
    public ?bool $tables;

    /**
     * Extract text content.
     */
    #[Api(optional: true)]
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
        $obj = new self;

        null !== $forms && $obj->forms = $forms;
        null !== $layout && $obj->layout = $layout;
        null !== $tables && $obj->tables = $tables;
        null !== $text && $obj->text = $text;

        return $obj;
    }

    /**
     * Detect form fields.
     */
    public function withForms(bool $forms): self
    {
        $obj = clone $this;
        $obj->forms = $forms;

        return $obj;
    }

    /**
     * Preserve document layout.
     */
    public function withLayout(bool $layout): self
    {
        $obj = clone $this;
        $obj->layout = $layout;

        return $obj;
    }

    /**
     * Detect and extract tables.
     */
    public function withTables(bool $tables): self
    {
        $obj = clone $this;
        $obj->tables = $tables;

        return $obj;
    }

    /**
     * Extract text content.
     */
    public function withText(bool $text): self
    {
        $obj = clone $this;
        $obj->text = $text;

        return $obj;
    }
}
