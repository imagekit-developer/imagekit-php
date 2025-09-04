<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new FileCopyParams); // set properties as needed
 * $client->files->copy(...$params->toArray());
 * ```
 * This will copy a file from one folder to another.
 *
 * Note: If any file at the destination has the same name as the source file, then the source file and its versions (if `includeFileVersions` is set to true) will be appended to the destination file version history.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->files->copy(...$params->toArray());`
 *
 * @see ImageKit\Files->copy
 *
 * @phpstan-type file_copy_params = array{
 *   destinationPath: string, sourceFilePath: string, includeFileVersions?: bool
 * }
 */
final class FileCopyParams implements BaseModel
{
    /** @use SdkModel<file_copy_params> */
    use SdkModel;
    use SdkParams;

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

    /**
     * `new FileCopyParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FileCopyParams::with(destinationPath: ..., sourceFilePath: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FileCopyParams)->withDestinationPath(...)->withSourceFilePath(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
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

    /**
     * Full path to the folder you want to copy the above file into.
     */
    public function withDestinationPath(string $destinationPath): self
    {
        $obj = clone $this;
        $obj->destinationPath = $destinationPath;

        return $obj;
    }

    /**
     * The full path of the file you want to copy.
     */
    public function withSourceFilePath(string $sourceFilePath): self
    {
        $obj = clone $this;
        $obj->sourceFilePath = $sourceFilePath;

        return $obj;
    }

    /**
     * Option to copy all versions of a file. By default, only the current version of the file is copied. When set to true, all versions of the file will be copied. Default value - `false`.
     */
    public function withIncludeFileVersions(bool $includeFileVersions): self
    {
        $obj = clone $this;
        $obj->includeFileVersions = $includeFileVersions;

        return $obj;
    }
}
