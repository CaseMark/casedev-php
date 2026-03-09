<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run\RunGetDetailsResponse\Usage\Entry;

enum Kind: string
{
    case LLM = 'llm';

    case API = 'api';
}
