<?php

declare(strict_types=1);

namespace Imagekit\Core\Contracts;

/**
 * @phpstan-import-type NormalizedRequest from \Imagekit\Core\BaseClient
 *
 * @internal
 *
 * @template Item
 *
 * @extends \IteratorAggregate<int, static>
 */
interface BasePage extends \IteratorAggregate
{
    public function hasNextPage(): bool;

    /**
     * @return list<Item>
     */
    public function getItems(): array;

    /**
     * @return static<Item>
     */
    public function getNextPage(): static;

    /**
     * @return \Generator<Item>
     */
    public function pagingEachItem(): \Generator;
}
