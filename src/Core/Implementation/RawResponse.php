<?php

namespace Imagekit\Core\Implementation;

use Imagekit\Client;
use Imagekit\Core\Concerns\ResponseProxy;
use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Conversion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;
use Imagekit\Core\Util;
use Imagekit\RequestOptions;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 *
 * @template R
 *
 * @implements BaseResponse<R>
 *
 * @phpstan-import-type normalized_request from \Imagekit\Core\BaseClient
 */
class RawResponse implements BaseResponse
{
    use ResponseProxy;

    private mixed $decodedBody;

    /** @var R */
    private mixed $coercedResponse;

    private bool $decoded = false;
    private bool $coerced = false;

    /**
     * @param normalized_request $requestInfo
     */
    public function __construct(
        private Client $client,
        private RequestOptions $options,
        private RequestInterface $request,
        private ResponseInterface $response,
        private array $requestInfo,
        private Converter|ConverterSource|string $convert,
        private ?string $page,
        private ?string $stream,
    ) {}

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function parse(): mixed
    {
        if (!$this->coerced) {
            if (!is_null($this->stream)) {
                // @phpstan-ignore-next-line assign.propertyType
                $this->coercedResponse = new $this->stream(
                    convert: $this->convert,
                    request: $this->request,
                    response: $this->response,
                    parsedBody: $this->getDecoded(),
                );
            } elseif (!is_null($this->page)) {
                // @phpstan-ignore-next-line assign.propertyType
                $this->coercedResponse = new $this->page(
                    convert: $this->convert,
                    client: $this->client,
                    requestInfo: $this->requestInfo,
                    options: $this->options,
                    response: $this->response,
                    parsedBody: $this->getDecoded(),
                );
            } else {
                // @phpstan-ignore-next-line assign.propertyType
                $this->coercedResponse = Conversion::coerce(
                    $this->convert,
                    value: $this->getDecoded(),
                );
            }

            $this->coerced = true;
        }

        return $this->coercedResponse;
    }

    private function getDecoded(): mixed
    {
        if (!$this->decoded) {
            $this->decodedBody = Util::decodeContent($this->response);
            $this->decoded = true;
        }

        return $this->decodedBody;
    }
}
