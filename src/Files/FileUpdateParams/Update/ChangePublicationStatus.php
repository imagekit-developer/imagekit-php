<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUpdateParams\Update;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Files\FileUpdateParams\Update\ChangePublicationStatus\Publish;

/**
 * @phpstan-type change_publication_status_alias = array{publish?: Publish}
 */
final class ChangePublicationStatus implements BaseModel
{
    use SdkModel;

    /**
     * Configure the publication status of a file and its versions.
     */
    #[Api(optional: true)]
    public ?Publish $publish;

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
    public static function with(?Publish $publish = null): self
    {
        $obj = new self;

        null !== $publish && $obj->publish = $publish;

        return $obj;
    }

    /**
     * Configure the publication status of a file and its versions.
     */
    public function withPublish(Publish $publish): self
    {
        $obj = clone $this;
        $obj->publish = $publish;

        return $obj;
    }
}
