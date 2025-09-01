<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationErrorEvent\Data\Transformation\Error;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specific reason for the transformation failure:
 * - `encoding_failed`: Error during video encoding process
 * - `download_failed`: Could not download source video
 * - `internal_server_error`: Unexpected server error
 */
final class Reason implements ConverterSource
{
    use SdkEnum;

    public const ENCODING_FAILED = 'encoding_failed';

    public const DOWNLOAD_FAILED = 'download_failed';

    public const INTERNAL_SERVER_ERROR = 'internal_server_error';
}
