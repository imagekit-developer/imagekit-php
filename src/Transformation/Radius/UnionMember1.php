<?php

declare(strict_types=1);

namespace ImageKit\Transformation\Radius;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

final class UnionMember1 implements ConverterSource
{
    use SdkEnum;

    public const MAX = 'max';
}
