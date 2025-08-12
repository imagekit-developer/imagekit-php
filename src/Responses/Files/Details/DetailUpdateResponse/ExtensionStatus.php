<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\Details\DetailUpdateResponse;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Responses\Files\Details\DetailUpdateResponse\ExtensionStatus\AwsAutoTagging;
use ImageKit\Responses\Files\Details\DetailUpdateResponse\ExtensionStatus\GoogleAutoTagging;
use ImageKit\Responses\Files\Details\DetailUpdateResponse\ExtensionStatus\RemoveBg;

/**
 * @phpstan-type extension_status_alias = array{
 *   awsAutoTagging?: AwsAutoTagging::*,
 *   googleAutoTagging?: GoogleAutoTagging::*,
 *   removeBg?: RemoveBg::*,
 * }
 */
final class ExtensionStatus implements BaseModel
{
    use Model;

    /** @var null|AwsAutoTagging::* $awsAutoTagging */
    #[Api('aws-auto-tagging', enum: AwsAutoTagging::class, optional: true)]
    public ?string $awsAutoTagging;

    /** @var null|GoogleAutoTagging::* $googleAutoTagging */
    #[Api('google-auto-tagging', enum: GoogleAutoTagging::class, optional: true)]
    public ?string $googleAutoTagging;

    /** @var null|RemoveBg::* $removeBg */
    #[Api('remove-bg', enum: RemoveBg::class, optional: true)]
    public ?string $removeBg;

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
     * @param null|AwsAutoTagging::* $awsAutoTagging
     * @param null|GoogleAutoTagging::* $googleAutoTagging
     * @param null|RemoveBg::* $removeBg
     */
    public static function from(
        ?string $awsAutoTagging = null,
        ?string $googleAutoTagging = null,
        ?string $removeBg = null,
    ): self {
        $obj = new self;

        null !== $awsAutoTagging && $obj->awsAutoTagging = $awsAutoTagging;
        null !== $googleAutoTagging && $obj->googleAutoTagging = $googleAutoTagging;
        null !== $removeBg && $obj->removeBg = $removeBg;

        return $obj;
    }

    /**
     * @param AwsAutoTagging::* $awsAutoTagging
     */
    public function setAwsAutoTagging(string $awsAutoTagging): self
    {
        $this->awsAutoTagging = $awsAutoTagging;

        return $this;
    }

    /**
     * @param GoogleAutoTagging::* $googleAutoTagging
     */
    public function setGoogleAutoTagging(string $googleAutoTagging): self
    {
        $this->googleAutoTagging = $googleAutoTagging;

        return $this;
    }

    /**
     * @param RemoveBg::* $removeBg
     */
    public function setRemoveBg(string $removeBg): self
    {
        $this->removeBg = $removeBg;

        return $this;
    }
}
