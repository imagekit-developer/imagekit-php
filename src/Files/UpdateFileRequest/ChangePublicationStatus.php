<?php

declare(strict_types=1);

namespace Imagekit\Files\UpdateFileRequest;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Files\UpdateFileRequest\ChangePublicationStatus\Publish;

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
    #[Optional]
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
        $self = new self;

        null !== $publish && $self['publish'] = $publish;

        return $self;
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
        $self = clone $this;
        $self['publish'] = $publish;

        return $self;
    }
}
