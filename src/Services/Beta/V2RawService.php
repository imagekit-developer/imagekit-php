<?php

declare(strict_types=1);

namespace Imagekit\Services\Beta;

use Imagekit\Client;
use Imagekit\ServiceContracts\Beta\V2RawContract;

final class V2RawService implements V2RawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
