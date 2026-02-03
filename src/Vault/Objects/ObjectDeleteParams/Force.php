<?php

declare(strict_types=1);

namespace Casedev\Vault\Objects\ObjectDeleteParams;

/**
 * Force delete a stuck document that is still in 'processing' state. Use this if a document got stuck during ingestion (e.g., OCR timeout).
 */
enum Force: string
{
    case TRUE = 'true';
}
