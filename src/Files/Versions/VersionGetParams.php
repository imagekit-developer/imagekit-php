<?php

declare(strict_types=1);

namespace ImageKit\Files\Versions;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Concerns\Params;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This API returns an object with details or attributes of a file version.
 *
 * @phpstan-type get_params = array{fileID: string}
 */
final class VersionGetParams implements BaseModel
{
    use Model;
    use Params;

    #[Api]
    public string $fileID;

    /**
     * `new VersionGetParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VersionGetParams::with(fileID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VersionGetParams)->withFileID(...)
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
    public static function with(string $fileID): self
    {
        $obj = new self;

        $obj->fileID = $fileID;

        return $obj;
    }

    public function withFileID(string $fileID): self
    {
        $obj = clone $this;
        $obj->fileID = $fileID;

        return $obj;
    }
}
