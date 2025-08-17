<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadParams\Extension\AutoTaggingExtension;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the auto-tagging extension used.
 *
 * @phpstan-type name_alias = Name::*
 */
final class Name implements ConverterSource
{
    use Enum;

    public const GOOGLE_AUTO_TAGGING = 'google-auto-tagging';

    public const AWS_AUTO_TAGGING = 'aws-auto-tagging';
}
