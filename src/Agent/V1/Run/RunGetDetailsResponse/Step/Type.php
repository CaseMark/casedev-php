<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run\RunGetDetailsResponse\Step;

enum Type: string
{
    case OUTPUT = 'output';

    case THINKING = 'thinking';

    case TOOL_CALL = 'tool_call';

    case TOOL_RESULT = 'tool_result';
}
