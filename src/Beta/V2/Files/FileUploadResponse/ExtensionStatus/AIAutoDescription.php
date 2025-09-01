<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadResponse\ExtensionStatus;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

final class AIAutoDescription implements ConverterSource
{
    use SdkEnum;

    public const SUCCESS = 'success';

    public const PENDING = 'pending';

    public const FAILED = 'failed';
}
