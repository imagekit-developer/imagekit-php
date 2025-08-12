<?php

declare(strict_types=1);

namespace ImageKit\Files\Details\DetailUpdateParams\RemoveAITags;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type union_member1_alias = UnionMember1::*
 */
final class UnionMember1 implements ConverterSource
{
    use Enum;

    public const ALL = 'all';
}
