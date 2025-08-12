<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadV1Params;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Whether to upload file as published or not.
 *
 * If `false`, the file is marked as unpublished, which restricts access to the file only via the media library. Files in draft or unpublished state can only be publicly accessed after being published.
 *
 * The option to upload in draft state is only available in custom enterprise pricing plans.
 *
 * @phpstan-type is_published_alias = IsPublished::*
 */
final class IsPublished implements ConverterSource
{
    use Enum;

    public const TRUE = 'true';

    public const FALSE = 'false';
}
