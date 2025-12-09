<?php

declare(strict_types=1);

namespace Imagekit\Folders;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkParams;
use Imagekit\Core\Contracts\BaseModel;

/**
 * This will move one folder into another. The selected folder, its nested folders, files, and their versions are moved in this operation. Note: If any file at the destination has the same name as the source file, then the source file and its versions will be appended to the destination file version history.
 *
 * @see Imagekit\Services\FoldersService::move()
 *
 * @phpstan-type FolderMoveParamsShape = array{
 *   destinationPath: string, sourceFolderPath: string
 * }
 */
final class FolderMoveParams implements BaseModel
{
    /** @use SdkModel<FolderMoveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Full path to the destination folder where you want to move the source folder into.
     */
    #[Required]
    public string $destinationPath;

    /**
     * The full path to the source folder you want to move.
     */
    #[Required]
    public string $sourceFolderPath;

    /**
     * `new FolderMoveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FolderMoveParams::with(destinationPath: ..., sourceFolderPath: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FolderMoveParams)->withDestinationPath(...)->withSourceFolderPath(...)
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
        string $sourceFolderPath
    ): self {
        $self = new self;

        $self['destinationPath'] = $destinationPath;
        $self['sourceFolderPath'] = $sourceFolderPath;

        return $self;
    }

    /**
     * Full path to the destination folder where you want to move the source folder into.
     */
    public function withDestinationPath(string $destinationPath): self
    {
        $self = clone $this;
        $self['destinationPath'] = $destinationPath;

        return $self;
    }

    /**
     * The full path to the source folder you want to move.
     */
    public function withSourceFolderPath(string $sourceFolderPath): self
    {
        $self = clone $this;
        $self['sourceFolderPath'] = $sourceFolderPath;

        return $self;
    }
}
