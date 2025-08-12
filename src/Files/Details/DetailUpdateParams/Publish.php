<?php

declare(strict_types=1);

namespace ImageKit\Files\Details\DetailUpdateParams;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Configure the publication status of a file and its versions.
 *
 * @phpstan-type publish_alias = array{
 *   isPublished: bool, includeFileVersions?: bool
 * }
 */
final class Publish implements BaseModel
{
    use Model;

    /**
     * Set to `true` to publish the file. Set to `false` to unpublish the file.
     */
    #[Api]
    public bool $isPublished;

    /**
     * Set to `true` to publish/unpublish all versions of the file. Set to `false` to publish/unpublish only the current version of the file.
     */
    #[Api(optional: true)]
    public ?bool $includeFileVersions;

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
    public static function from(
        bool $isPublished,
        ?bool $includeFileVersions = null
    ): self {
        $obj = new self;

        $obj->isPublished = $isPublished;

        null !== $includeFileVersions && $obj->includeFileVersions = $includeFileVersions;

        return $obj;
    }

    /**
     * Set to `true` to publish the file. Set to `false` to unpublish the file.
     */
    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * Set to `true` to publish/unpublish all versions of the file. Set to `false` to publish/unpublish only the current version of the file.
     */
    public function setIncludeFileVersions(bool $includeFileVersions): self
    {
        $this->includeFileVersions = $includeFileVersions;

        return $this;
    }
}
