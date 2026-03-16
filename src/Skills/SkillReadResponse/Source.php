<?php

declare(strict_types=1);

namespace CaseDev\Skills\SkillReadResponse;

/**
 * Skill source (authenticated requests only).
 */
enum Source: string
{
    case CURATED = 'curated';

    case CUSTOM = 'custom';
}
