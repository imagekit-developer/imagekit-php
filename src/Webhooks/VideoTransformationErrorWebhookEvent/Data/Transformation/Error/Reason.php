<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationErrorWebhookEvent\Data\Transformation\Error;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type reason_alias = Reason::*
 */
final class Reason implements ConverterSource
{
    use SdkEnum;

    public const ENCODING_FAILED = 'encoding_failed';

    public const DOWNLOAD_FAILED = 'download_failed';

    public const INTERNAL_SERVER_ERROR = 'internal_server_error';
}
