<?php

declare(strict_types=1);

namespace ImageKit\Files\Versions;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Concerns\Params;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This API restores a file version as the current file version.
 *
 * @phpstan-type restore_params = array{fileID: string}
 */
final class VersionRestoreParams implements BaseModel
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
    public static function from(string $fileID): self
    {
        $obj = new self;

        $obj->fileID = $fileID;

        return $obj;
    }

    public function setFileID(string $fileID): self
    {
        $this->fileID = $fileID;

        return $this;
    }
}
