<?php

declare(strict_types=1);

namespace ImageKit\Core\Contracts;

use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 *
 * @template TInner
 *
 * @extends \IteratorAggregate<int, TInner>
 */
interface BaseStream extends \IteratorAggregate
{
    public function __construct(
        Converter|ConverterSource|string $convert,
        RequestInterface $request,
        ResponseInterface $response,
        mixed $parsedBody,
    );

    /**
     * Manually force the stream to close early.
     * Iterating through will automatically close as well.
     */
    public function close(): void;
}
