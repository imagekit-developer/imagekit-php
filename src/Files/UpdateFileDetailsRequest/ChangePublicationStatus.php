<?php

declare(strict_types=1);

namespace ImageKit\Files\UpdateFileDetailsRequest;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Files\UpdateFileDetailsRequest\ChangePublicationStatus\Publish;

/**
 * @phpstan-type change_publication_status = array{publish?: Publish}
 */
final class ChangePublicationStatus implements BaseModel
{
    /** @use SdkModel<change_publication_status> */
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
