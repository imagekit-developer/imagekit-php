<?php

declare(strict_types=1);

namespace ImageKit\BulkJobs;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Concerns\Params;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This will move one folder into another. The selected folder, its nested folders, files, and their versions are moved in this operation. Note: If any file at the destination has the same name as the source file, then the source file and its versions will be appended to the destination file version history.
 *
 * @phpstan-type move_folder_params = array{
 *   destinationPath: string, sourceFolderPath: string
 * }
 */
final class BulkJobMoveFolderParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * Full path to the destination folder where you want to move the source folder into.
     */
    #[Api]
    public string $destinationPath;

    /**
     * The full path to the source folder you want to move.
     */
    #[Api]
    public string $sourceFolderPath;

    /**
     * `new BulkJobMoveFolderParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkJobMoveFolderParams::with(destinationPath: ..., sourceFolderPath: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BulkJobMoveFolderParams)
     *   ->withDestinationPath(...)
     *   ->withSourceFolderPath(...)
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
    public static function with(
        string $destinationPath,
        string $sourceFolderPath
    ): self {
        $obj = new self;

        $obj->destinationPath = $destinationPath;
        $obj->sourceFolderPath = $sourceFolderPath;

        return $obj;
    }

    /**
     * Full path to the destination folder where you want to move the source folder into.
     */
    public function withDestinationPath(string $destinationPath): self
    {
        $obj = clone $this;
        $obj->destinationPath = $destinationPath;

        return $obj;
    }

    /**
     * The full path to the source folder you want to move.
     */
    public function withSourceFolderPath(string $sourceFolderPath): self
    {
        $obj = clone $this;
        $obj->sourceFolderPath = $sourceFolderPath;

        return $obj;
    }
}
