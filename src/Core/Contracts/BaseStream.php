<?php

declare(strict_types=1);

namespace Imagekit\Core\Contracts;

use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;
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
    );

    /**
     * Manually force the stream to close early.
     * Iterating through will automatically close as well.
     */
    public function close(): void;
}
