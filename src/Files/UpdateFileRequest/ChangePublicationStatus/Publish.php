<?php

declare(strict_types=1);

namespace Imagekit\Files\UpdateFileRequest\ChangePublicationStatus;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * Configure the publication status of a file and its versions.
 *
 * @phpstan-type PublishShape = array{
 *   isPublished: bool, includeFileVersions?: bool|null
 * }
 */
final class Publish implements BaseModel
{
    /** @use SdkModel<PublishShape> */
    use SdkModel;

    /**
     * Set to `true` to publish the file. Set to `false` to unpublish the file.
     */
    #[Required]
    public bool $isPublished;

    /**
     * Set to `true` to publish/unpublish all versions of the file. Set to `false` to publish/unpublish only the current version of the file.
     */
    #[Optional]
    public ?bool $includeFileVersions;

    /**
     * `new Publish()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Publish::with(isPublished: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Publish)->withIsPublished(...)
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
        bool $isPublished,
        ?bool $includeFileVersions = null
    ): self {
        $self = new self;

        $self['isPublished'] = $isPublished;

        null !== $includeFileVersions && $self['includeFileVersions'] = $includeFileVersions;

        return $self;
    }

    /**
     * Set to `true` to publish the file. Set to `false` to unpublish the file.
     */
    public function withIsPublished(bool $isPublished): self
    {
        $self = clone $this;
        $self['isPublished'] = $isPublished;

        return $self;
    }

    /**
     * Set to `true` to publish/unpublish all versions of the file. Set to `false` to publish/unpublish only the current version of the file.
     */
    public function withIncludeFileVersions(bool $includeFileVersions): self
    {
        $self = clone $this;
        $self['includeFileVersions'] = $includeFileVersions;

        return $self;
    }
}
