<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadParams;

use ImageKit\Beta\V2\Files\FileUploadParams\Extension\AIAutoDescription;
use ImageKit\Beta\V2\Files\FileUploadParams\Extension\AutoTaggingExtension;
use ImageKit\Beta\V2\Files\FileUploadParams\Extension\RemoveBg;
use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

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
