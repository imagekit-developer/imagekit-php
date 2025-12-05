<?php

declare(strict_types=1);

namespace ImageKit\Files\UpdateFileRequest;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Files\UpdateFileRequest\ChangePublicationStatus\Publish;

/**
 * @phpstan-type ChangePublicationStatusShape = array{publish?: Publish|null}
 */
final class ChangePublicationStatus implements BaseModel
{
    /** @use SdkModel<ChangePublicationStatusShape> */
    use SdkModel;

    /**
     * Configure the publication status of a file and its versions.
     */
    #[Api(optional: true)]
    public ?Publish $publish;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Publish|array{
     *   isPublished: bool, includeFileVersions?: bool|null
     * } $publish
     */
    public static function with(Publish|array|null $publish = null): self
    {
        $obj = new self;

        null !== $publish && $obj['publish'] = $publish;

        return $obj;
    }

    /**
     * Configure the publication status of a file and its versions.
     *
     * @param Publish|array{
     *   isPublished: bool, includeFileVersions?: bool|null
     * } $publish
     */
    public function withPublish(Publish|array $publish): self
    {
        $obj = clone $this;
        $obj['publish'] = $publish;

        return $obj;
    }
}
