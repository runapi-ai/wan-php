<?php

declare(strict_types=1);

namespace RunApi\Wan;

use RunApi\Core\BaseClient;
use RunApi\Core\ClientOptions;
use RunApi\Wan\Resources\Animate;
use RunApi\Wan\Resources\EditVideo;
use RunApi\Wan\Resources\ImageToVideo;
use RunApi\Wan\Resources\SpeechToVideo;
use RunApi\Wan\Resources\TextToImage;
use RunApi\Wan\Resources\TextToVideo;

/**
 * The Wan video and image generation API client.
 *
 * Exposes typed model resources plus the universal files and account resources.
 */
final class WanClient extends BaseClient
{
    /**
     * Provides text-to-video generation operations.
     */
    public readonly TextToVideo $textToVideo;
    /**
     * Provides image-to-video generation operations.
     */
    public readonly ImageToVideo $imageToVideo;
    /**
     * Provides speech-driven video generation operations.
     */
    public readonly SpeechToVideo $speechToVideo;
    /**
     * Provides animation operations.
     */
    public readonly Animate $animate;
    /**
     * Provides text-to-image operations.
     */
    public readonly TextToImage $textToImage;
    /**
     * Provides video editing operations.
     */
    public readonly EditVideo $editVideo;

    /**
     * Create a Wan client with optional API key, base URL, and transport overrides.
     */
    public function __construct(ClientOptions $options = new ClientOptions())
    {
        parent::__construct($options);
        $this->textToVideo = TextToVideo::fromHttp($this->http);
        $this->imageToVideo = ImageToVideo::fromHttp($this->http);
        $this->speechToVideo = SpeechToVideo::fromHttp($this->http);
        $this->animate = Animate::fromHttp($this->http);
        $this->textToImage = TextToImage::fromHttp($this->http);
        $this->editVideo = EditVideo::fromHttp($this->http);
    }
}
