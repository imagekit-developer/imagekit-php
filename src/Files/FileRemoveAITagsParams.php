<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Concerns\Params;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\ListOf;

/**
 * This API removes AITags from multiple files in bulk. A maximum of 50 files can be specified at a time.
 *
 * @phpstan-type remove_ai_tags_params = array{
 *   aiTags: list<string>, fileIDs: list<string>
 * }
 */
final class FileRemoveAITagsParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * An array of AITags that you want to remove from the files.
     *
     * @var list<string> $aiTags
     */
    #[Api('AITags', type: new ListOf('string'))]
    public array $aiTags;

    /**
     * An array of fileIds from which you want to remove AITags.
     *
     * @var list<string> $fileIDs
     */
    #[Api('fileIds', type: new ListOf('string'))]
    public array $fileIDs;

    /**
     * `new FileRemoveAITagsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FileRemoveAITagsParams::with(aiTags: ..., fileIDs: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FileRemoveAITagsParams)->withAITags(...)->withFileIDs(...)
     * ```
     */
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
     * @param list<string> $aiTags
     * @param list<string> $fileIDs
     */
    public static function with(array $aiTags, array $fileIDs): self
    {
        $obj = new self;

        $obj->aiTags = $aiTags;
        $obj->fileIDs = $fileIDs;

        return $obj;
    }

    /**
     * An array of AITags that you want to remove from the files.
     *
     * @param list<string> $aiTags
     */
    public function withAITags(array $aiTags): self
    {
        $obj = clone $this;
        $obj->aiTags = $aiTags;

        return $obj;
    }

    /**
     * An array of fileIds from which you want to remove AITags.
     *
     * @param list<string> $fileIDs
     */
    public function withFileIDs(array $fileIDs): self
    {
        $obj = clone $this;
        $obj->fileIDs = $fileIDs;

        return $obj;
    }
}
