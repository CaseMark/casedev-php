<?php

declare(strict_types=1);

namespace Casedev\Ocr\V1\V1ProcessParams;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Ocr\V1\V1ProcessParams\Features\Tables;

/**
 * Additional processing options.
 *
 * @phpstan-import-type TablesShape from \Casedev\Ocr\V1\V1ProcessParams\Features\Tables
 *
 * @phpstan-type FeaturesShape = array{
 *   embed?: array<string,mixed>|null,
 *   forms?: array<string,mixed>|null,
 *   tables?: null|Tables|TablesShape,
 * }
 */
final class Features implements BaseModel
{
    /** @use SdkModel<FeaturesShape> */
    use SdkModel;

    /**
     * Generate searchable PDF with text layer.
     *
     * @var array<string,mixed>|null $embed
     */
    #[Optional(map: 'mixed')]
    public ?array $embed;

    /**
     * Detect and extract form fields.
     *
     * @var array<string,mixed>|null $forms
     */
    #[Optional(map: 'mixed')]
    public ?array $forms;

    /**
     * Extract tables as structured data.
     */
    #[Optional]
    public ?Tables $tables;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,mixed>|null $embed
     * @param array<string,mixed>|null $forms
     * @param Tables|TablesShape|null $tables
     */
    public static function with(
        ?array $embed = null,
        ?array $forms = null,
        Tables|array|null $tables = null
    ): self {
        $self = new self;

        null !== $embed && $self['embed'] = $embed;
        null !== $forms && $self['forms'] = $forms;
        null !== $tables && $self['tables'] = $tables;

        return $self;
    }

    /**
     * Generate searchable PDF with text layer.
     *
     * @param array<string,mixed> $embed
     */
    public function withEmbed(array $embed): self
    {
        $self = clone $this;
        $self['embed'] = $embed;

        return $self;
    }

    /**
     * Detect and extract form fields.
     *
     * @param array<string,mixed> $forms
     */
    public function withForms(array $forms): self
    {
        $self = clone $this;
        $self['forms'] = $forms;

        return $self;
    }

    /**
     * Extract tables as structured data.
     *
     * @param Tables|TablesShape $tables
     */
    public function withTables(Tables|array $tables): self
    {
        $self = clone $this;
        $self['tables'] = $tables;

        return $self;
    }
}
