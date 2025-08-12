<?php

declare(strict_types=1);

namespace ImageKit\Core\Concerns;

use ImageKit\Core\BaseClient;
use ImageKit\Core\Pagination\PageRequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
interface Page
{
    public function __construct(
        BaseClient $client,
        PageRequestOptions $options,
        ResponseInterface $response,
        mixed $body,
    );
}
