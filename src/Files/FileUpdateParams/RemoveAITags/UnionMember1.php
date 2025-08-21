<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUpdateParams\RemoveAITags;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type union_member1_alias = UnionMember1::*
 */
final class UnionMember1 implements ConverterSource
{
    use SdkEnum;

    public const ALL = 'all';
}
