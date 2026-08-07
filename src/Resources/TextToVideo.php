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
 * Generates videos from text prompts. On WAN 2.6, multi_shots controls whether
 * the generated video uses multiple shots with transitions instead of one continuous shot.
 */
readonly class TextToVideo extends TypedConfiguredResource
{
    /**
     * Submits a text-to-video generation task and returns immediately with the task id.
     *
     * @param array{
     *   model: string,
     *   prompt?: string,
     *   aspect_ratio?: string,
     *   duration_seconds?: int,
     *   output_resolution?: string,
     *   multi_shots?: bool,
     *   callback_url?: string
     * } $params
     */
    public function create(array $params, ?RequestOptions $options = null): TaskCreateResponse
    {
        return parent::create($params, $options);
    }

    /**
     * Retrieves the current status and result of a text-to-video task.
     */
    public function get(string $id, ?RequestOptions $options = null): VideoTaskResponse
    {
        $response = parent::get($id, $options);

        /** @var VideoTaskResponse $response */
        return $response;
    }

    /**
     * Submits a text-to-video task and polls until it completes or fails.
     *
     * @param array{
     *   model: string,
     *   prompt?: string,
     *   aspect_ratio?: string,
     *   duration_seconds?: int,
     *   output_resolution?: string,
     *   multi_shots?: bool,
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
        return new self($http, '/api/v1/wan/text_to_video', 'wan/text-to-video', VideoTaskResponse::class, CompletedVideoTaskResponse::class, Types::TEXT_TO_VIDEO_MODELS, 'text-to-video', VideoTaskResponse::class, CompletedVideoTaskResponse::class);
    }
}
