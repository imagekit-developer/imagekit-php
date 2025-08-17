<?php

declare(strict_types=1);

namespace ImageKit\Assets\AssetListParams;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Sort the results by one of the supported fields in ascending or descending order.
 *
 * @phpstan-type sort_alias = Sort::*
 */
final class Sort implements ConverterSource
{
    use Enum;

    public const ASC_NAME = 'ASC_NAME';

    public const DESC_NAME = 'DESC_NAME';

    public const ASC_CREATED = 'ASC_CREATED';

    public const DESC_CREATED = 'DESC_CREATED';

    public const ASC_UPDATED = 'ASC_UPDATED';

    public const DESC_UPDATED = 'DESC_UPDATED';

    public const ASC_HEIGHT = 'ASC_HEIGHT';

    public const DESC_HEIGHT = 'DESC_HEIGHT';

    public const ASC_WIDTH = 'ASC_WIDTH';

    public const DESC_WIDTH = 'DESC_WIDTH';

    public const ASC_SIZE = 'ASC_SIZE';

    public const DESC_SIZE = 'DESC_SIZE';

    public const ASC_RELEVANCE = 'ASC_RELEVANCE';

    public const DESC_RELEVANCE = 'DESC_RELEVANCE';
}
