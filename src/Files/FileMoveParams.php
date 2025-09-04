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
 * $params = (new FileMoveParams); // set properties as needed
 * $client->files->move(...$params->toArray());
 * ```
 * This will move a file and all its versions from one folder to another.
 *
 * Note: If any file at the destination has the same name as the source file, then the source file and its versions will be appended to the destination file.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->files->move(...$params->toArray());`
 *
 * @see ImageKit\Files->move
 *
 * @phpstan-type file_move_params = array{
 *   destinationPath: string, sourceFilePath: string
 * }
 */
final class FileMoveParams implements BaseModel
{
    /** @use SdkModel<file_move_params> */
    use SdkModel;
    use SdkParams;

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
        $obj = new self;

        $obj->destinationPath = $destinationPath;
        $obj->sourceFilePath = $sourceFilePath;

        return $obj;
    }

    /**
     * Full path to the folder you want to move the above file into.
     */
    public function withDestinationPath(string $destinationPath): self
    {
        $obj = clone $this;
        $obj->destinationPath = $destinationPath;

        return $obj;
    }

    /**
     * The full path of the file you want to move.
     */
    public function withSourceFilePath(string $sourceFilePath): self
    {
        $obj = clone $this;
        $obj->sourceFilePath = $sourceFilePath;

        return $obj;
    }
}
