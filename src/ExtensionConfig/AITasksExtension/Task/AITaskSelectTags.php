<?php

declare(strict_types=1);

namespace Imagekit\ExtensionConfig\AITasksExtension\Task;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type AITaskSelectTagsShape = array{
 *   instruction: string,
 *   type: 'select_tags',
 *   vocabulary: list<string>,
 *   maxSelections?: int|null,
 *   minSelections?: int|null,
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
     * Array of possible tag values. Combined length of all strings must not exceed 500 characters. Cannot contain the `%` character.
     *
     * @var list<string> $vocabulary
     */
    #[Required(list: 'string')]
    public array $vocabulary;

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
     * `new AITaskSelectTags()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AITaskSelectTags::with(instruction: ..., vocabulary: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AITaskSelectTags)->withInstruction(...)->withVocabulary(...)
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
     * @param list<string> $vocabulary
     */
    public static function with(
        string $instruction,
        array $vocabulary,
        ?int $maxSelections = null,
        ?int $minSelections = null,
    ): self {
        $self = new self;

        $self['instruction'] = $instruction;
        $self['vocabulary'] = $vocabulary;

        null !== $maxSelections && $self['maxSelections'] = $maxSelections;
        null !== $minSelections && $self['minSelections'] = $minSelections;

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
     * Array of possible tag values. Combined length of all strings must not exceed 500 characters. Cannot contain the `%` character.
     *
     * @param list<string> $vocabulary
     */
    public function withVocabulary(array $vocabulary): self
    {
        $self = clone $this;
        $self['vocabulary'] = $vocabulary;

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
}
