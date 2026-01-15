<?php

declare(strict_types=1);

namespace Imagekit\ExtensionConfig\AITasksExtension\Task;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\ExtensionConfig\AITasksExtension\Task\AITaskSelectMetadata\Vocabulary;

/**
 * @phpstan-import-type VocabularyVariants from \Imagekit\ExtensionConfig\AITasksExtension\Task\AITaskSelectMetadata\Vocabulary
 * @phpstan-import-type VocabularyShape from \Imagekit\ExtensionConfig\AITasksExtension\Task\AITaskSelectMetadata\Vocabulary
 *
 * @phpstan-type AITaskSelectMetadataShape = array{
 *   field: string,
 *   instruction: string,
 *   type: 'select_metadata',
 *   maxSelections?: int|null,
 *   minSelections?: int|null,
 *   vocabulary?: list<VocabularyShape>|null,
 * }
 */
final class AITaskSelectMetadata implements BaseModel
{
    /** @use SdkModel<AITaskSelectMetadataShape> */
    use SdkModel;

    /**
     * Task type that analyzes the image and sets a custom metadata field value from a vocabulary.
     *
     * @var 'select_metadata' $type
     */
    #[Required]
    public string $type = 'select_metadata';

    /**
     * Name of the custom metadata field to set. The field must exist in your account.
     */
    #[Required]
    public string $field;

    /**
     * The question or instruction for the AI to analyze the image.
     */
    #[Required]
    public string $instruction;

    /**
     * Maximum number of values to select from the vocabulary.
     */
    #[Optional('max_selections')]
    public ?int $maxSelections;

    /**
     * Minimum number of values to select from the vocabulary.
     */
    #[Optional('min_selections')]
    public ?int $minSelections;

    /**
     * Array of possible values matching the custom metadata field type.
     *
     * @var list<VocabularyVariants>|null $vocabulary
     */
    #[Optional(list: Vocabulary::class)]
    public ?array $vocabulary;

    /**
     * `new AITaskSelectMetadata()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AITaskSelectMetadata::with(field: ..., instruction: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AITaskSelectMetadata)->withField(...)->withInstruction(...)
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
     *
     * @param list<VocabularyShape>|null $vocabulary
     */
    public static function with(
        string $field,
        string $instruction,
        ?int $maxSelections = null,
        ?int $minSelections = null,
        ?array $vocabulary = null,
    ): self {
        $self = new self;

        $self['field'] = $field;
        $self['instruction'] = $instruction;

        null !== $maxSelections && $self['maxSelections'] = $maxSelections;
        null !== $minSelections && $self['minSelections'] = $minSelections;
        null !== $vocabulary && $self['vocabulary'] = $vocabulary;

        return $self;
    }

    /**
     * Name of the custom metadata field to set. The field must exist in your account.
     */
    public function withField(string $field): self
    {
        $self = clone $this;
        $self['field'] = $field;

        return $self;
    }

    /**
     * The question or instruction for the AI to analyze the image.
     */
    public function withInstruction(string $instruction): self
    {
        $self = clone $this;
        $self['instruction'] = $instruction;

        return $self;
    }

    /**
     * Maximum number of values to select from the vocabulary.
     */
    public function withMaxSelections(int $maxSelections): self
    {
        $self = clone $this;
        $self['maxSelections'] = $maxSelections;

        return $self;
    }

    /**
     * Minimum number of values to select from the vocabulary.
     */
    public function withMinSelections(int $minSelections): self
    {
        $self = clone $this;
        $self['minSelections'] = $minSelections;

        return $self;
    }

    /**
     * Array of possible values matching the custom metadata field type.
     *
     * @param list<VocabularyShape> $vocabulary
     */
    public function withVocabulary(array $vocabulary): self
    {
        $self = clone $this;
        $self['vocabulary'] = $vocabulary;

        return $self;
    }
}
