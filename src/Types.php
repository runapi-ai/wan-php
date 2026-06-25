<?php

declare(strict_types=1);

namespace RunApi\Wan;

/**
 * Constants for model slugs supported by the Wan PHP SDK.
 */
final class Types
{
    /** @var list<string> */
    public const TEXT_TO_VIDEO_MODELS = ['wan-2.2-a14b-text-to-video-turbo', 'wan-2.5-text-to-video', 'wan-2.6-text-to-video', 'wan-2.7-r2v', 'wan-2.7-text-to-video'];
    /** @var list<string> */
    public const IMAGE_TO_VIDEO_MODELS = ['wan-2.2-a14b-image-to-video-turbo', 'wan-2.5-image-to-video', 'wan-2.6-flash-image-to-video', 'wan-2.6-image-to-video', 'wan-2.7-image-to-video'];
    /** @var list<string> */
    public const SPEECH_TO_VIDEO_MODELS = ['wan-2.2-a14b-speech-to-video-turbo'];
    /** @var list<string> */
    public const ANIMATE_MODELS = ['wan-2.2-animate-move', 'wan-2.2-animate-replace'];
    /** @var list<string> */
    public const TEXT_TO_IMAGE_MODELS = ['wan-2.7-image', 'wan-2.7-image-pro'];
    /** @var list<string> */
    public const EDIT_VIDEO_MODELS = ['wan-2.6-edit-video', 'wan-2.6-flash-edit-video', 'wan-2.7-edit-video'];

    private function __construct()
    {
    }
}
