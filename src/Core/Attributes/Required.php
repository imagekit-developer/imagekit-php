<?php

declare(strict_types=1);

namespace Imagekit\Core\Attributes;

use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;
use Imagekit\Core\Conversion\EnumOf;
use Imagekit\Core\Conversion\ListOf;
use Imagekit\Core\Conversion\MapOf;

/**
 * @internal
 */
#[\Attribute(\Attribute::TARGET_PROPERTY)]
class Required
{
    /** @var class-string<ConverterSource>|Converter|string|null */
    public readonly Converter|string|null $type;

    public readonly ?string $apiName;

    public bool $optional;

    public readonly bool $nullable;

    /**
     * @param class-string<ConverterSource>|Converter|string|null $type
     * @param class-string<\BackedEnum>|Converter|null            $enum
     * @param class-string<ConverterSource>|Converter|null        $union
     * @param class-string<ConverterSource>|Converter|string|null $list
     * @param class-string<ConverterSource>|Converter|string|null $map
     */
    public function __construct(
        ?string $apiName = null,
        Converter|string|null $type = null,
        Converter|string|null $enum = null,
        Converter|string|null $union = null,
        Converter|string|null $list = null,
        Converter|string|null $map = null,
        bool $nullable = false,
    ) {
        $type ??= $union;
        if (null !== $list) {
            $type ??= new ListOf($list);
        }
        if (null !== $map) {
            $type ??= new MapOf($map);
        }
        if (null !== $enum) {
            $type ??= $enum instanceof Converter ? $enum : EnumOf::fromBackedEnum($enum);
        }

        $this->apiName = $apiName;
        $this->type = $type;
        $this->optional = false;
        $this->nullable = $nullable;
    }
}
