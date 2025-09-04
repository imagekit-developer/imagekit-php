<?php

declare(strict_types=1);

namespace ImageKit\ExtensionItem\AutoTaggingExtension;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the auto-tagging extension used.
 */
final class Name implements ConverterSource
{
    use SdkEnum;

    public const GOOGLE_AUTO_TAGGING = 'google-auto-tagging';

    public const AWS_AUTO_TAGGING = 'aws-auto-tagging';
}
