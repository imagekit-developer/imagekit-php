<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationErrorEvent\Data\Transformation\Error;

/**
 * Specific reason for the transformation failure:
 * - `encoding_failed`: Error during video encoding process
 * - `download_failed`: Could not download source video
 * - `internal_server_error`: Unexpected server error
 */
enum Reason: string
{
    case ENCODING_FAILED = 'encoding_failed';

    case DOWNLOAD_FAILED = 'download_failed';

    case INTERNAL_SERVER_ERROR = 'internal_server_error';
}
