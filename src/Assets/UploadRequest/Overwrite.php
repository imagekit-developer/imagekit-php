<?php

declare(strict_types=1);

namespace ImageKit\Assets\UploadRequest;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Controls what gets replaced when a file already exists at the same path. All fields default to `true`. Only relevant when `use_unique_file_name` is `false`.
 *
 * @phpstan-type OverwriteShape = array{
 *   aiTags?: bool|null,
 *   customMetadata?: bool|null,
 *   file?: bool|null,
 *   tags?: bool|null,
 * }
 */
final class Overwrite implements BaseModel
{
    /** @use SdkModel<OverwriteShape> */
    use SdkModel;

    /**
     * If `true`, existing `ai_tags` on the file are removed on overwrite. Set to `false` to preserve them.
     */
    #[Optional('ai_tags')]
    public ?bool $aiTags;

    /**
     * If `true` and `custom_metadata` is not provided in the request, existing custom metadata is removed on overwrite. Set to `false` to preserve it.
     */
    #[Optional('custom_metadata')]
    public ?bool $customMetadata;

    /**
     * If `false`, the upload returns an error when a file already exists at the target path instead of replacing it.
     */
    #[Optional]
    public ?bool $file;

    /**
     * If `true` and `tags` is not provided in the request, existing tags are removed on overwrite. Set to `false` to preserve them.
     */
    #[Optional]
    public ?bool $tags;

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
        ?bool $aiTags = null,
        ?bool $customMetadata = null,
        ?bool $file = null,
        ?bool $tags = null,
    ): self {
        $self = new self;

        null !== $aiTags && $self['aiTags'] = $aiTags;
        null !== $customMetadata && $self['customMetadata'] = $customMetadata;
        null !== $file && $self['file'] = $file;
        null !== $tags && $self['tags'] = $tags;

        return $self;
    }

    /**
     * If `true`, existing `ai_tags` on the file are removed on overwrite. Set to `false` to preserve them.
     */
    public function withAITags(bool $aiTags): self
    {
        $self = clone $this;
        $self['aiTags'] = $aiTags;

        return $self;
    }

    /**
     * If `true` and `custom_metadata` is not provided in the request, existing custom metadata is removed on overwrite. Set to `false` to preserve it.
     */
    public function withCustomMetadata(bool $customMetadata): self
    {
        $self = clone $this;
        $self['customMetadata'] = $customMetadata;

        return $self;
    }

    /**
     * If `false`, the upload returns an error when a file already exists at the target path instead of replacing it.
     */
    public function withFile(bool $file): self
    {
        $self = clone $this;
        $self['file'] = $file;

        return $self;
    }

    /**
     * If `true` and `tags` is not provided in the request, existing tags are removed on overwrite. Set to `false` to preserve them.
     */
    public function withTags(bool $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }
}
