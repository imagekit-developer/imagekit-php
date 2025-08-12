<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Concerns\Params;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This will copy a file from one folder to another.
 *
 * Note: If any file at the destination has the same name as the source file, then the source file and its versions (if `includeFileVersions` is set to true) will be appended to the destination file version history.
 *
 * @phpstan-type copy_params = array{
 *   destinationPath: string, sourceFilePath: string, includeFileVersions?: bool
 * }
 */
final class FileCopyParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * Full path to the folder you want to copy the above file into.
     */
    #[Api]
    public string $destinationPath;

    /**
     * The full path of the file you want to copy.
     */
    #[Api]
    public string $sourceFilePath;

    /**
     * Option to copy all versions of a file. By default, only the current version of the file is copied. When set to true, all versions of the file will be copied. Default value - `false`.
     */
    #[Api(optional: true)]
    public ?bool $includeFileVersions;

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
    public static function new(
        string $destinationPath,
        string $sourceFilePath,
        ?bool $includeFileVersions = null,
    ): self {
        $obj = new self;

        $obj->destinationPath = $destinationPath;
        $obj->sourceFilePath = $sourceFilePath;

        null !== $includeFileVersions && $obj->includeFileVersions = $includeFileVersions;

        return $obj;
    }
}
