<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUpdateParams\Update\UpdateFileDetails;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Files\FileUpdateParams\Update\UpdateFileDetails\Extension\AIAutoDescription;
use ImageKit\Files\FileUpdateParams\Update\UpdateFileDetails\Extension\AutoTaggingExtension;
use ImageKit\Files\FileUpdateParams\Update\UpdateFileDetails\Extension\RemoveBg;

/**
 * @phpstan-type extension_alias = RemoveBg|AutoTaggingExtension|AIAutoDescription
 */
final class Extension implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'name';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return [
            AutoTaggingExtension::class,
            'remove-bg' => RemoveBg::class,
            'ai-auto-description' => AIAutoDescription::class,
        ];
    }
}
