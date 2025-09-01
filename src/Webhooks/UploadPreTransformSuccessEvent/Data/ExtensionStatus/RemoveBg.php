<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\UploadPreTransformSuccessEvent\Data\ExtensionStatus;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

final class RemoveBg implements ConverterSource
{
    use SdkEnum;

    public const SUCCESS = 'success';

    public const PENDING = 'pending';

    public const FAILED = 'failed';
}
