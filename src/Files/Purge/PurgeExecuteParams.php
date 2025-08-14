<?php

declare(strict_types=1);

namespace ImageKit\Files\Purge;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Concerns\Params;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This API will purge CDN cache and ImageKit.io's internal cache for a file.  Note: Purge cache is an asynchronous process and it may take some time to reflect the changes.
 *
 * @phpstan-type execute_params = array{url: string}
 */
final class PurgeExecuteParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * The full URL of the file to be purged.
     */
    #[Api]
    public string $url;

    /**
     * `new PurgeExecuteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PurgeExecuteParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PurgeExecuteParams)->withURL(...)
     * ```
     */
    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $url): self
    {
        $obj = new self;

        $obj->url = $url;

        return $obj;
    }

    /**
     * The full URL of the file to be purged.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }
}
