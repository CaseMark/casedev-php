<?php

declare(strict_types=1);

namespace CaseDev\Vault\Objects\ObjectGetPagesResponse\Metadata;

/**
 * Where the page text came from. `ocr` for PDFs (per-page OCR sidecar). `txt` for plain-text files split on form-feed (\f) characters.
 */
enum Source: string
{
    case OCR = 'ocr';

    case TXT = 'txt';
}
