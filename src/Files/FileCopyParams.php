<?php

declare(strict_types=1);

namespace Imagekit\Files;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkParams;
use Imagekit\Core\Contracts\BaseModel;

/**
 * This will copy a file from one folder to another.
 *
 * Note: If any file at the destination has the same name as the source file, then the source file and its versions (if `includeFileVersions` is set to true) will be appended to the destination file version history.
 *
 * @see Imagekit\Services\FilesService::copy()
 *
 * @phpstan-type FileCopyParamsShape = array{
 *   destinationPath: string, sourceFilePath: string, includeFileVersions?: bool
 * }
 */
final class FileCopyParams implements BaseModel
{
    /** @use SdkModel<FileCopyParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Full path to the folder you want to copy the above file into.
     */
    #[Required]
    public string $destinationPath;

    /**
     * The full path of the file you want to copy.
     */
    #[Required]
    public string $sourceFilePath;

    /**
     * Option to copy all versions of a file. By default, only the current version of the file is copied. When set to true, all versions of the file will be copied. Default value - `false`.
     */
    #[Optional]
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
        $self = new self;

        $self['destinationPath'] = $destinationPath;
        $self['sourceFilePath'] = $sourceFilePath;

        null !== $includeFileVersions && $self['includeFileVersions'] = $includeFileVersions;

        return $self;
    }

    /**
     * Full path to the folder you want to copy the above file into.
     */
    public function withDestinationPath(string $destinationPath): self
    {
        $self = clone $this;
        $self['destinationPath'] = $destinationPath;

        return $self;
    }

    /**
     * The full path of the file you want to copy.
     */
    public function withSourceFilePath(string $sourceFilePath): self
    {
        $self = clone $this;
        $self['sourceFilePath'] = $sourceFilePath;

        return $self;
    }

    /**
     * Option to copy all versions of a file. By default, only the current version of the file is copied. When set to true, all versions of the file will be copied. Default value - `false`.
     */
    public function withIncludeFileVersions(bool $includeFileVersions): self
    {
        $self = clone $this;
        $self['includeFileVersions'] = $includeFileVersions;

        return $self;
    }
}
