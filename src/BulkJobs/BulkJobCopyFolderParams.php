<?php

declare(strict_types=1);

namespace ImageKit\BulkJobs;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Concerns\Params;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This will copy one folder into another. The selected folder, its nested folders, files, and their versions (in `includeVersions` is set to true) are copied in this operation. Note: If any file at the destination has the same name as the source file, then the source file and its versions will be appended to the destination file version history.
 *
 * @phpstan-type copy_folder_params = array{
 *   destinationPath: string, sourceFolderPath: string, includeVersions?: bool
 * }
 */
final class BulkJobCopyFolderParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * Full path to the destination folder where you want to copy the source folder into.
     */
    #[Api]
    public string $destinationPath;

    /**
     * The full path to the source folder you want to copy.
     */
    #[Api]
    public string $sourceFolderPath;

    /**
     * Option to copy all versions of files that are nested inside the selected folder. By default, only the current version of each file will be copied. When set to true, all versions of each file will be copied. Default value - `false`.
     */
    #[Api(optional: true)]
    public ?bool $includeVersions;

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
    public static function from(
        string $destinationPath,
        string $sourceFolderPath,
        ?bool $includeVersions = null,
    ): self {
        $obj = new self;

        $obj->destinationPath = $destinationPath;
        $obj->sourceFolderPath = $sourceFolderPath;

        null !== $includeVersions && $obj->includeVersions = $includeVersions;

        return $obj;
    }

    /**
     * Full path to the destination folder where you want to copy the source folder into.
     */
    public function setDestinationPath(string $destinationPath): self
    {
        $this->destinationPath = $destinationPath;

        return $this;
    }

    /**
     * The full path to the source folder you want to copy.
     */
    public function setSourceFolderPath(string $sourceFolderPath): self
    {
        $this->sourceFolderPath = $sourceFolderPath;

        return $this;
    }

    /**
     * Option to copy all versions of files that are nested inside the selected folder. By default, only the current version of each file will be copied. When set to true, all versions of each file will be copied. Default value - `false`.
     */
    public function setIncludeVersions(bool $includeVersions): self
    {
        $this->includeVersions = $includeVersions;

        return $this;
    }
}
