<?php

declare(strict_types=1);

namespace Imagekit;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;
use Imagekit\ExtensionItem\AIAutoDescription;
use Imagekit\ExtensionItem\AutoTaggingExtension;
use Imagekit\ExtensionItem\RemoveBg;

final class ExtensionItem implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'name';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
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
