<?php

declare(strict_types=1);

namespace CaseDev\Skills\SkillReadResponse;

use CaseDev\Core\Concerns\SdkUnion;
use CaseDev\Core\Conversion\Contracts\Converter;
use CaseDev\Core\Conversion\Contracts\ConverterSource;
use CaseDev\Skills\ReadResponseFileBundle;
use CaseDev\Skills\ReadResponseRootBundle;

/**
 * Skill bundle metadata for root skills and companion file rows.
 *
 * @phpstan-import-type ReadResponseRootBundleShape from \CaseDev\Skills\ReadResponseRootBundle
 * @phpstan-import-type ReadResponseFileBundleShape from \CaseDev\Skills\ReadResponseFileBundle
 *
 * @phpstan-type BundleVariants = ReadResponseRootBundle|ReadResponseFileBundle
 * @phpstan-type BundleShape = BundleVariants|ReadResponseRootBundleShape|ReadResponseFileBundleShape
 */
final class Bundle implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [ReadResponseRootBundle::class, ReadResponseFileBundle::class];
    }
}
