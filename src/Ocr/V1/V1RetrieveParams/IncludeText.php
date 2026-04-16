<?php

declare(strict_types=1);

namespace CaseDev\Ocr\V1\V1RetrieveParams;

/**
 * Include full OCR text in completed responses (default: true).
 */
enum IncludeText: string
{
    case TRUE = 'true';

    case FALSE = 'false';
}
