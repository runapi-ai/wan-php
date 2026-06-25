<?php

declare(strict_types=1);

namespace RunApi\Wan\Resources;

use RunApi\Core\Http\HttpClient;
use RunApi\Core\Models\TaskCreateResponse;
use RunApi\Core\RequestOptions;
use RunApi\Core\Resources\TypedConfiguredResource;
use RunApi\Wan\Models\CompletedVideoTaskResponse;
use RunApi\Wan\Models\VideoTaskResponse;
use RunApi\Wan\Types;

/**
 * Generates lip-synced talking-head videos from a portrait image and speech audio.
 */
readonly class SpeechToVideo extends TypedConfiguredResource
{
    /**
     * Submits a speech-to-video lip-sync task and returns immediately with the task id.
     *
     * @param array{
     *   model: string,
     *   prompt?: string,
     *   source_image_url?: string,
     *   source_audio_url?: string,
     *   output_resolution?: string,
     *   callback_url?: string
     * } $params
     */
    public function create(array $params, ?RequestOptions $options = null): TaskCreateResponse
    {
        return parent::create($params, $options);
    }

    /**
     * Retrieves the current status and result of a speech-to-video task.
     */
    public function get(string $id, ?RequestOptions $options = null): VideoTaskResponse
    {
        $response = parent::get($id, $options);

        /** @var VideoTaskResponse $response */
        return $response;
    }

    /**
     * Submits a speech-to-video task and polls until it completes or fails.
     *
     * @param array{
     *   model: string,
     *   prompt?: string,
     *   source_image_url?: string,
     *   source_audio_url?: string,
     *   output_resolution?: string,
     *   callback_url?: string
     * } $params
     */
    public function run(array $params, ?RequestOptions $options = null): CompletedVideoTaskResponse
    {
        $response = parent::run($params, $options);

        /** @var CompletedVideoTaskResponse $response */
        return $response;
    }

    /**
     * Create the resource using the shared RunAPI HTTP transport.
     */
    public static function fromHttp(HttpClient $http): self
    {
        return new self($http, '/api/v1/wan/speech_to_video', 'wan/speech-to-video', VideoTaskResponse::class, CompletedVideoTaskResponse::class, Types::SPEECH_TO_VIDEO_MODELS, 'speech-to-video', VideoTaskResponse::class, CompletedVideoTaskResponse::class);
    }
}
