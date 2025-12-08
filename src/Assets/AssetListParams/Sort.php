<?php

declare(strict_types=1);

namespace Imagekit\Assets\AssetListParams;

/**
 * Sort the results by one of the supported fields in ascending or descending order.
 */
enum Sort: string
{
    case ASC_NAME = 'ASC_NAME';

    case DESC_NAME = 'DESC_NAME';

    case ASC_CREATED = 'ASC_CREATED';

    case DESC_CREATED = 'DESC_CREATED';

    case ASC_UPDATED = 'ASC_UPDATED';

    case DESC_UPDATED = 'DESC_UPDATED';

    case ASC_HEIGHT = 'ASC_HEIGHT';

    case DESC_HEIGHT = 'DESC_HEIGHT';

    case ASC_WIDTH = 'ASC_WIDTH';

    case DESC_WIDTH = 'DESC_WIDTH';

    case ASC_SIZE = 'ASC_SIZE';

    case DESC_SIZE = 'DESC_SIZE';

    case ASC_RELEVANCE = 'ASC_RELEVANCE';

    case DESC_RELEVANCE = 'DESC_RELEVANCE';
}
