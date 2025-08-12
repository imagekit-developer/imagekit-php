<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\Details\DetailUpdateResponse\ExtensionStatus;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type remove_bg_alias = RemoveBg::*
 */
final class RemoveBg implements ConverterSource
{
    use Enum;

    public const SUCCESS = 'success';

    public const PENDING = 'pending';

    public const FAILED = 'failed';
}
