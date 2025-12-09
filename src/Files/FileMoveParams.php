<?php

declare(strict_types=1);

namespace Imagekit\Files;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkParams;
use Imagekit\Core\Contracts\BaseModel;

/**
 * This will move a file and all its versions from one folder to another.
 *
 * Note: If any file at the destination has the same name as the source file, then the source file and its versions will be appended to the destination file.
 *
 * @see Imagekit\Services\FilesService::move()
 *
 * @phpstan-type FileMoveParamsShape = array{
 *   destinationPath: string, sourceFilePath: string
 * }
 */
final class FileMoveParams implements BaseModel
{
    /** @use SdkModel<FileMoveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Full path to the folder you want to move the above file into.
     */
    #[Required]
    public string $destinationPath;

    /**
     * The full path of the file you want to move.
     */
    #[Required]
    public string $sourceFilePath;

    /**
     * `new FileMoveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FileMoveParams::with(destinationPath: ..., sourceFilePath: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FileMoveParams)->withDestinationPath(...)->withSourceFilePath(...)
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
        string $sourceFilePath
    ): self {
        $self = new self;

        $self['destinationPath'] = $destinationPath;
        $self['sourceFilePath'] = $sourceFilePath;

        return $self;
    }

    /**
     * Full path to the folder you want to move the above file into.
     */
    public function withDestinationPath(string $destinationPath): self
    {
        $self = clone $this;
        $self['destinationPath'] = $destinationPath;

        return $self;
    }

    /**
     * The full path of the file you want to move.
     */
    public function withSourceFilePath(string $sourceFilePath): self
    {
        $self = clone $this;
        $self['sourceFilePath'] = $sourceFilePath;

        return $self;
    }
}
