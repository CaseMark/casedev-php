<?php

declare(strict_types=1);

namespace CaseDev\Skills\SkillResolveResponse\Result;

/**
 * Whether the skill is curated or org-custom.
 */
enum Source: string
{
    case CURATED = 'curated';

    case CUSTOM = 'custom';
}
