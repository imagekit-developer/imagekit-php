<?php

declare(strict_types=1);

namespace ImageKit\ExtensionConfig\AutoTaggingExtension;

/**
 * Specifies the auto-tagging extension used.
 */
enum Name: string
{
    case GOOGLE_AUTO_TAGGING = 'google-auto-tagging';

    case AWS_AUTO_TAGGING = 'aws-auto-tagging';
}
