<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\DamFileVersionDeleteEvent;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type DataShape = array{fileID: string, versionID: string}
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * The unique `fileId` of the deleted file.
     */
    #[Required('fileId')]
    public string $fileID;

    /**
     * The unique `versionId` of the deleted file version.
     */
    #[Required('versionId')]
    public string $versionID;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(fileID: ..., versionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withFileID(...)->withVersionID(...)
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
    public static function with(string $fileID, string $versionID): self
    {
        $self = new self;

        $self['fileID'] = $fileID;
        $self['versionID'] = $versionID;

        return $self;
    }

    /**
     * The unique `fileId` of the deleted file.
     */
    public function withFileID(string $fileID): self
    {
        $self = clone $this;
        $self['fileID'] = $fileID;

        return $self;
    }

    /**
     * The unique `versionId` of the deleted file version.
     */
    public function withVersionID(string $versionID): self
    {
        $self = clone $this;
        $self['versionID'] = $versionID;

        return $self;
    }
}
