<?php

declare(strict_types=1);

namespace ImageKit\Files\Versions;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Concerns\Params;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This API deletes a non-current file version permanently. The API returns an empty response.
 *
 * Note: If you want to delete all versions of a file, use the delete file API.
 *
 * @phpstan-type delete_params = array{fileID: string}
 */
final class VersionDeleteParams implements BaseModel
{
    use Model;
    use Params;

    #[Api]
    public string $fileID;

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
    public static function new(string $fileID): self
    {
        $obj = new self;

        $obj->fileID = $fileID;

        return $obj;
    }
}
