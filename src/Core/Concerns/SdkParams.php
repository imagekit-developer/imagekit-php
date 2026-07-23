<?php

declare(strict_types=1);

namespace ImageKit\Core\Concerns;

use ImageKit\Core\Conversion;
use ImageKit\Core\Conversion\DumpState;
use ImageKit\RequestOptions;

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
        $converter = self::converter();
        $state = new DumpState;
        $dumped = (array) Conversion::dump($converter, value: $params, state: $state);
        // @phpstan-ignore-next-line argument.type
        $opts = RequestOptions::parse($options);

        if (!$state->canRetry) {
            $opts->maxRetries = 0;
        }

        // @phpstan-ignore-next-line return.type
        return [$dumped, $opts];
    }
}
