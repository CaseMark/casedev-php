<?php

declare(strict_types=1);

namespace CaseDev\Database\V1\Projects\ProjectCreateParams;

/**
 * AWS region for database deployment.
 */
enum Region: string
{
    case AWS_US_EAST_1 = 'aws-us-east-1';

    case AWS_US_EAST_2 = 'aws-us-east-2';

    case AWS_US_WEST_2 = 'aws-us-west-2';

    case AWS_EU_CENTRAL_1 = 'aws-eu-central-1';

    case AWS_EU_WEST_1 = 'aws-eu-west-1';

    case AWS_EU_WEST_2 = 'aws-eu-west-2';

    case AWS_AP_SOUTHEAST_1 = 'aws-ap-southeast-1';

    case AWS_AP_SOUTHEAST_2 = 'aws-ap-southeast-2';
}
