<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadResponse\ExtensionStatus;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

final class AwsAutoTagging implements ConverterSource
{
    use SdkEnum;

    public const SUCCESS = 'success';

    public const PENDING = 'pending';

    public const FAILED = 'failed';
}
