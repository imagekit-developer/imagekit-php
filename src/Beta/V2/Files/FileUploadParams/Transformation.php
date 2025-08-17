<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadParams;

use ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post;
use ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post\AdaptiveBitrateStreaming;
use ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post\ConvertGifToVideo;
use ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post\GenerateAThumbnail;
use ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post\SimplePostTransformation;
use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\ListOf;

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
 * @phpstan-type transformation_alias = array{
 *   post?: list<SimplePostTransformation|ConvertGifToVideo|GenerateAThumbnail|AdaptiveBitrateStreaming>,
 *   pre?: string,
 * }
 */
final class Transformation implements BaseModel
{
    use Model;

    /**
     * List of transformations to apply *after* the file is uploaded.
     * Each item must match one of the following types:
     * `transformation`, `gif-to-video`, `thumbnail`, `abs`.
     *
     * @var null|list<AdaptiveBitrateStreaming|ConvertGifToVideo|GenerateAThumbnail|SimplePostTransformation> $post
     */
    #[Api(type: new ListOf(union: Post::class), optional: true)]
    public ?array $post;

    /**
     * Transformation string to apply before uploading the file to the Media Library. Useful for optimizing files at ingestion.
     */
    #[Api(optional: true)]
    public ?string $pre;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param null|list<AdaptiveBitrateStreaming|ConvertGifToVideo|GenerateAThumbnail|SimplePostTransformation> $post
     */
    public static function with(?array $post = null, ?string $pre = null): self
    {
        $obj = new self;

        null !== $post && $obj->post = $post;
        null !== $pre && $obj->pre = $pre;

        return $obj;
    }

    /**
     * List of transformations to apply *after* the file is uploaded.
     * Each item must match one of the following types:
     * `transformation`, `gif-to-video`, `thumbnail`, `abs`.
     *
     * @param list<AdaptiveBitrateStreaming|ConvertGifToVideo|GenerateAThumbnail|SimplePostTransformation> $post
     */
    public function withPost(array $post): self
    {
        $obj = clone $this;
        $obj->post = $post;

        return $obj;
    }

    /**
     * Transformation string to apply before uploading the file to the Media Library. Useful for optimizing files at ingestion.
     */
    public function withPre(string $pre): self
    {
        $obj = clone $this;
        $obj->pre = $pre;

        return $obj;
    }
}
