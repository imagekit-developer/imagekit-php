<?php

namespace ImageKit;

use ImageKit\Core\Conversion;
use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkPage;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Contracts\BasePage;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use Psr\Http\Message\ResponseInterface;

/**
  *
  * @phpstan-type CursorShape = array{
  *   items?: list<mixed>|null, startCursor?: string|null, endCursor?: string|null
  * }
  * @template TItem
  * @implements BasePage<TItem>
  *
 */
final class Cursor implements BaseModel, BasePage
{
  /** @use SdkModel<CursorShape> */
  use SdkModel;

  /** @use SdkPage<TItem> */
  use SdkPage;

  /** @var list<TItem>|null $items */
  #[Optional(list: 'mixed')]
  public ?array $items;

  /** @var string|null $startCursor */
  #[Optional('start_cursor', nullable: true)]
  public ?string $startCursor;

  /** @var string|null $endCursor */
  #[Optional('end_cursor', nullable: true)]
  public ?string $endCursor;

  /** @return list<TItem> */
  function getItems(): array {
    // @phpstan-ignore-next-line return.type
    return $this->offsetGet('items') ?? [];
  }

  /**
  * @internal
  *
  * @return array{
  *   array{
  *     method: string,
  *     path: string,
  *     query: array<string,mixed>,
  *     headers: array<string,string|null|list<string>>,
  *     body: mixed,
  *   },
  *   RequestOptions,
  * }|null
 */
  function nextRequest(): ?array {
    if (!count($this->getItems())) {
      return null;

    }

    if (!($prev = $this->startCursor ?? null)&&!($next = $this
      ->endCursor ?? null)) {
      return null;

    }

    $nextRequest = array_merge_recursive(
      $this->requestInfo,
      ['query' => empty($prev) ? ['cursor' => $next] : [=> $prev]],
    );

    // @phpstan-ignore-next-line return.type
    return [$nextRequest, $this->options];
  }

  /**
  * @internal
  *
  * @param string|Converter|ConverterSource $convert
  * @param Client $client
  * @param array{
  *   method: string,
  *   path: string,
  *   query: array<string,mixed>,
  *   headers: array<string,string|null|list<string>>,
  *   body: mixed,
  * } $requestInfo
  * @param RequestOptions $options
  * @param mixed $parsedBody
 */
  function __construct(
    private string|Converter|ConverterSource $convert,
    private Client $client,
    private array $requestInfo,
    private RequestOptions $options,
    private ResponseInterface $response,
    private mixed $parsedBody,
  ) {
    $this->initialize();

    if (!is_array($this->parsedBody)) {
      return;

    }

    // @phpstan-ignore-next-line argument.type
    self::__unserialize($this->parsedBody);

    if (is_array($items = $this->offsetGet('items'))) {
      $parsed = Conversion::coerce(new ListOf($convert), value: $items);
      // @phpstan-ignore-next-line
      $this->offsetSet('items', value: $parsed);

    }
  }
}