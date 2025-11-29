<?php

declare(strict_types=1);

namespace Casedev\Ocr\V1\V1DownloadParams;

enum Type: string
{
    case TEXT = 'text';

    case JSON = 'json';

    case PDF = 'pdf';

    case ORIGINAL = 'original';
}
