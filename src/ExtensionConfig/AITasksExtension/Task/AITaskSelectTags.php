<?php

declare(strict_types=1);

namespace ImageKit\ExtensionConfig\AITasksExtension\Task;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type AITaskSelectTagsShape = array{
 *   instruction: string,
 *   type: 'select_tags',
 *   maxSelections?: int|null,
 *   minSelections?: int|null,
 *   vocabulary?: list<string>|null,
 * }
 */
final class AITaskSelectTags implements BaseModel
{
    /** @use SdkModel<AITaskSelectTagsShape> */
    use SdkModel;

    /**
     * Task type that analyzes the image and adds matching tags from a vocabulary.
     *
     * @var 'select_tags' $type
     */
    #[Required]
    public string $type = 'select_tags';

    /**
     * The question or instruction for the AI to analyze the image.
     */
    #[Required]
    public string $instruction;

    /**
     * Maximum number of tags to select from the vocabulary.
     */
    #[Optional('max_selections')]
    public ?int $maxSelections;

    /**
     * Minimum number of tags to select from the vocabulary.
     */
    #[Optional('min_selections')]
    public ?int $minSelections;

    /**
     * Array of possible tag values. The combined length of all strings must not exceed 500 characters, and values cannot include the `%` character. When providing large vocabularies (more than 30 items), the AI may not follow the list strictly.
     *
     * @var list<string>|null $vocabulary
     */
    #[Optional(list: 'string')]
    public ?array $vocabulary;

    /**
     * `new AITaskSelectTags()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AITaskSelectTags::with(instruction: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AITaskSelectTags)->withInstruction(...)
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
     * @param list<string>|null $vocabulary
     */
    public static function with(
        string $instruction,
        ?int $maxSelections = null,
        ?int $minSelections = null,
        ?array $vocabulary = null,
    ): self {
        $self = new self;

        $self['instruction'] = $instruction;

        null !== $maxSelections && $self['maxSelections'] = $maxSelections;
        null !== $minSelections && $self['minSelections'] = $minSelections;
        null !== $vocabulary && $self['vocabulary'] = $vocabulary;

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
     * Task type that analyzes the image and adds matching tags from a vocabulary.
     *
     * @param 'select_tags' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Maximum number of tags to select from the vocabulary.
     */
    public function withMaxSelections(int $maxSelections): self
    {
        $self = clone $this;
        $self['maxSelections'] = $maxSelections;

        return $self;
    }

    /**
     * Minimum number of tags to select from the vocabulary.
     */
    public function withMinSelections(int $minSelections): self
    {
        $self = clone $this;
        $self['minSelections'] = $minSelections;

        return $self;
    }

    /**
     * Array of possible tag values. The combined length of all strings must not exceed 500 characters, and values cannot include the `%` character. When providing large vocabularies (more than 30 items), the AI may not follow the list strictly.
     *
     * @param list<string> $vocabulary
     */
    public function withVocabulary(array $vocabulary): self
    {
        $self = clone $this;
        $self['vocabulary'] = $vocabulary;

        return $self;
    }
}
