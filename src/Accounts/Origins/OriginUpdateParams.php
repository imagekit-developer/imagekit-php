<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Origins;

use ImageKit\Accounts\Origins\OriginRequest\AkeneoPim;
use ImageKit\Accounts\Origins\OriginRequest\AzureBlob;
use ImageKit\Accounts\Origins\OriginRequest\CloudinaryBackup;
use ImageKit\Accounts\Origins\OriginRequest\Gcs;
use ImageKit\Accounts\Origins\OriginRequest\S3;
use ImageKit\Accounts\Origins\OriginRequest\S3Compatible;
use ImageKit\Accounts\Origins\OriginRequest\WebFolder;
use ImageKit\Accounts\Origins\OriginRequest\WebProxy;
use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * **Note:** This API is currently in beta.
 * Updates the origin identified by `id` and returns the updated origin object.
 *
 * @phpstan-type origin_update_params = array{
 *   origin: S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim,
 * }
 */
final class OriginUpdateParams implements BaseModel
{
    /** @use SdkModel<origin_update_params> */
    use SdkModel;
    use SdkParams;

    /**
     * Schema for origin request resources.
     */
    #[Api(union: OriginRequest::class)]
    public S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim $origin;

    /**
     * `new OriginUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OriginUpdateParams::with(origin: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OriginUpdateParams)->withOrigin(...)
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
     */
    public static function with(
        S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim $origin,
    ): self {
        $obj = new self;

        $obj->origin = $origin;

        return $obj;
    }

    /**
     * Schema for origin request resources.
     */
    public function withOrigin(
        S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim $origin,
    ): self {
        $obj = clone $this;
        $obj->origin = $origin;

        return $obj;
    }
}
