<?php

declare(strict_types=1);

namespace ImageKit\Responses\Beta\V2\Files\FileUploadResponse\ExtensionStatus;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type google_auto_tagging_alias = GoogleAutoTagging::*
 */
final class GoogleAutoTagging implements ConverterSource
{
    use SdkEnum;

    public const SUCCESS = 'success';

    public const PENDING = 'pending';

    public const FAILED = 'failed';
}
