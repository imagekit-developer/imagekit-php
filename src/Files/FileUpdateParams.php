<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Files\FileUpdateParams\Update\ChangePublicationStatus;
use ImageKit\Files\FileUpdateParams\Update\UpdateFileDetails;

/**
 * This API updates the details or attributes of the current version of the file. You can update `tags`, `customCoordinates`, `customMetadata`, publication status, remove existing `AITags` and apply extensions using this API.
 *
 * @see ImageKit\Files->update
 *
 * @phpstan-type file_update_params = array{
 *   update?: UpdateFileDetails|ChangePublicationStatus
 * }
 */
final class FileUpdateParams implements BaseModel
{
    /** @use SdkModel<file_update_params> */
    use SdkModel;
    use SdkParams;

    #[Api(optional: true)]
    public UpdateFileDetails|ChangePublicationStatus|null $update;

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
    public static function with(
        UpdateFileDetails|ChangePublicationStatus|null $update = null
    ): self {
        $obj = new self;

        null !== $update && $obj->update = $update;

        return $obj;
    }

    public function withUpdate(
        UpdateFileDetails|ChangePublicationStatus $update
    ): self {
        $obj = clone $this;
        $obj->update = $update;

        return $obj;
    }
}
