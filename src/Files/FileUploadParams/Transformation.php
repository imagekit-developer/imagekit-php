<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadParams;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Files\FileUploadParams\Transformation\Post;

/**
 * Configure pre-processing (`pre`) and post-processing (`post`) transformations.
 *
 * - `pre` — applied before the file is uploaded to the Media Library.
 *   Useful for reducing file size or applying basic optimizations upfront (e.g., resize, compress).
 *
 * - `post` — applied immediately after upload.
 *   Ideal for generating transformed versions (like video encodes or thumbnails) in advance, so they're ready for delivery without delay.
 *
 * You can mix and match any combination of post-processing types.
 *
 * @phpstan-import-type PostVariants from \ImageKit\Files\FileUploadParams\Transformation\Post
 * @phpstan-import-type PostShape from \ImageKit\Files\FileUploadParams\Transformation\Post
 *
 * @phpstan-type TransformationShape = array{
 *   post?: list<PostShape>|null, pre?: string|null
 * }
 */
final class Transformation implements BaseModel
{
    /** @use SdkModel<TransformationShape> */
    use SdkModel;

    /**
     * List of transformations to apply *after* the file is uploaded.
     * Each item must match one of the following types:
     * `transformation`, `gif-to-video`, `thumbnail`, `abs`.
     *
     * @var list<PostVariants>|null $post
     */
    #[Optional(list: Post::class)]
    public ?array $post;

    /**
     * Transformation string to apply before uploading the file to the Media Library. Useful for optimizing files at ingestion.
     */
    #[Optional]
    public ?string $pre;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<PostShape>|null $post
     */
    public static function with(?array $post = null, ?string $pre = null): self
    {
        $self = new self;

        null !== $post && $self['post'] = $post;
        null !== $pre && $self['pre'] = $pre;

        return $self;
    }

    /**
     * List of transformations to apply *after* the file is uploaded.
     * Each item must match one of the following types:
     * `transformation`, `gif-to-video`, `thumbnail`, `abs`.
     *
     * @param list<PostShape> $post
     */
    public function withPost(array $post): self
    {
        $self = clone $this;
        $self['post'] = $post;

        return $self;
    }

    /**
     * Transformation string to apply before uploading the file to the Media Library. Useful for optimizing files at ingestion.
     */
    public function withPre(string $pre): self
    {
        $self = clone $this;
        $self['pre'] = $pre;

        return $self;
    }
}
