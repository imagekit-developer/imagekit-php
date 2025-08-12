<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Concerns\Params;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This will move a file and all its versions from one folder to another.
 *
 * Note: If any file at the destination has the same name as the source file, then the source file and its versions will be appended to the destination file.
 *
 * @phpstan-type move_params = array{
 *   destinationPath: string, sourceFilePath: string
 * }
 */
final class FileMoveParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * Full path to the folder you want to move the above file into.
     */
    #[Api]
    public string $destinationPath;

    /**
     * The full path of the file you want to move.
     */
    #[Api]
    public string $sourceFilePath;

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
        string $sourceFilePath
    ): self {
        $obj = new self;

        $obj->destinationPath = $destinationPath;
        $obj->sourceFilePath = $sourceFilePath;

        return $obj;
    }
}
