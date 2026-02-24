<?php

declare(strict_types=1);

namespace CaseDev\Search\V1\V1AnswerParams;

/**
 * Type of search to perform.
 */
enum SearchType: string
{
    case AUTO = 'auto';

    case WEB = 'web';

    case NEWS = 'news';

    case ACADEMIC = 'academic';
}
