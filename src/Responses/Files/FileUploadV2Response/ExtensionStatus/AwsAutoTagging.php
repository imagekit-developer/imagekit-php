<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\FileUploadV2Response\ExtensionStatus;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type aws_auto_tagging_alias = AwsAutoTagging::*
 */
final class AwsAutoTagging implements ConverterSource
{
    use Enum;

    public const SUCCESS = 'success';

    public const PENDING = 'pending';

    public const FAILED = 'failed';
}
