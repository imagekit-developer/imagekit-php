<?php

declare(strict_types=1);

namespace ImageKit\Core\Contracts;

use ImageKit\Core\BaseClient;
use ImageKit\Core\Pagination\PageRequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
interface BasePage
{
    public function __construct(
        BaseClient $client,
        PageRequestOptions $options,
        ResponseInterface $response,
        mixed $body,
    );
}
