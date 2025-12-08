<?php

declare(strict_types=1);

namespace Imagekit\Folders;

use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkResponse;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type FolderDeleteResponseShape = array<string,mixed>
 */
final class FolderDeleteResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<FolderDeleteResponseShape> */
    use SdkModel;

    use SdkResponse;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(): self
    {
        return new self;
    }
}
