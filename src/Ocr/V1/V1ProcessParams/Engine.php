<?php

declare(strict_types=1);

namespace Casedev\Ocr\V1\V1ProcessParams;

/**
 * OCR engine to use.
 */
enum Engine: string
{
    case DOCTR = 'doctr';

    case PADDLEOCR = 'paddleocr';
}
