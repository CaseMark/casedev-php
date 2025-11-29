<?php

declare(strict_types=1);

namespace Casedev\Format\V1\Templates\TemplateCreateParams;

/**
 * Template type.
 */
enum Type: string
{
    case CAPTION = 'caption';

    case SIGNATURE = 'signature';

    case LETTERHEAD = 'letterhead';

    case CERTIFICATE = 'certificate';

    case FOOTER = 'footer';

    case CUSTOM = 'custom';
}
