<?php

declare(strict_types=1);

namespace ImageKit\Assets\AssetUpdateResponse\ExtensionStatus;

enum AwsAutoTagging: string
{
    case SUCCESS = 'success';

    case PENDING = 'pending';

    case FAILED = 'failed';
}
