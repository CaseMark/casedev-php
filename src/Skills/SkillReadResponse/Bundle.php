<?php

declare(strict_types=1);

namespace CaseDev\Skills\SkillReadResponse;

use CaseDev\Core\Concerns\SdkUnion;
use CaseDev\Core\Conversion\Contracts\Converter;
use CaseDev\Core\Conversion\Contracts\ConverterSource;
use CaseDev\Skills\SkillReadResponse\Bundle\UnionMember0;
use CaseDev\Skills\SkillReadResponse\Bundle\UnionMember1;

/**
 * Skill bundle metadata for root skills and companion file rows.
 *
 * @phpstan-import-type UnionMember0Shape from \CaseDev\Skills\SkillReadResponse\Bundle\UnionMember0
 * @phpstan-import-type UnionMember1Shape from \CaseDev\Skills\SkillReadResponse\Bundle\UnionMember1
 *
 * @phpstan-type BundleVariants = UnionMember0|UnionMember1
 * @phpstan-type BundleShape = BundleVariants|UnionMember0Shape|UnionMember1Shape
 */
final class Bundle implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [UnionMember0::class, UnionMember1::class];
    }
}
