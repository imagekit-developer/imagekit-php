<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\FileUpdateResponse\ExtensionStatus;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type ai_auto_description_alias = AIAutoDescription::*
 */
final class AIAutoDescription implements ConverterSource
{
    use Enum;

    public const SUCCESS = 'success';

    public const PENDING = 'pending';

    public const FAILED = 'failed';
}
