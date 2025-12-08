<?php

declare(strict_types=1);

namespace Imagekit\Core\Concerns;

use Imagekit\Core\Conversion;
use Imagekit\Core\Conversion\DumpState;
use Imagekit\Core\Util;
use Imagekit\RequestOptions;

/**
 * @internal
 */
trait SdkParams
{
    /**
     * @param array<string, mixed>|RequestOptions|null $options
     *
     * @return array{array<string, mixed>, RequestOptions}
     */
    public static function parseRequest(mixed $params, array|RequestOptions|null $options): array
    {
        $value = is_array($params) ? Util::array_filter_omit($params) : $params;
        $converter = self::converter();
        $state = new DumpState;
        $dumped = (array) Conversion::dump($converter, value: $value, state: $state);
        $opts = RequestOptions::parse($options); // @phpstan-ignore-line

        if (!$state->canRetry) {
            $opts->maxRetries = 0;
        }

        return [$dumped, $opts]; // @phpstan-ignore-line
    }
}
