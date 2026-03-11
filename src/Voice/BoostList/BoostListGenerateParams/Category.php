<?php

declare(strict_types=1);

namespace CaseDev\Voice\BoostList\BoostListGenerateParams;

enum Category: string
{
    case PERSON = 'person';

    case ORGANIZATION = 'organization';

    case LEGAL_TERM = 'legal_term';

    case MEDICAL = 'medical';

    case CITATION = 'citation';

    case EMAIL = 'email';
}
