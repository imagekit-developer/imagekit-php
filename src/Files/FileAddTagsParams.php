<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Concerns\Params;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\ListOf;

/**
 * This API adds tags to multiple files in bulk. A maximum of 50 files can be specified at a time.
 *
 * @phpstan-type add_tags_params = array{fileIDs: list<string>, tags: list<string>}
 */
final class FileAddTagsParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * An array of fileIds to which you want to add tags.
     *
     * @var list<string> $fileIDs
     */
    #[Api('fileIds', type: new ListOf('string'))]
    public array $fileIDs;

    /**
     * An array of tags that you want to add to the files.
     *
     * @var list<string> $tags
     */
    #[Api(type: new ListOf('string'))]
    public array $tags;

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
     * @param list<string> $fileIDs
     * @param list<string> $tags
     */
    public static function new(array $fileIDs, array $tags): self
    {
        $obj = new self;

        $obj->fileIDs = $fileIDs;
        $obj->tags = $tags;

        return $obj;
    }
}
