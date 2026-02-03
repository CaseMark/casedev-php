<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Holds\HoldCreateParams\ReleaseCondition;

enum Type: string
{
    case MANUAL_APPROVAL = 'manual_approval';

    case DOCUMENT_SIGNED = 'document_signed';

    case DATE_REACHED = 'date_reached';
}
