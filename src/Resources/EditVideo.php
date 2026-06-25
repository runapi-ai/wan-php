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
 * Modifies existing videos guided by a text prompt. The prompt describes the desired changes; a reference image can further guide the edit.
 */
readonly class EditVideo extends TypedConfiguredResource
{
    /**
     * Submits a video editing task and returns immediately with the task id.
     *
     * @param array{
     *   model: string,
     *   prompt?: string,
     *   source_video_url?: string,
     *   source_video_urls?: list<string>,
     *   aspect_ratio?: string,
     *   output_resolution?: string,
     *   callback_url?: string
     * } $params
     */
    public function create(array $params, ?RequestOptions $options = null): TaskCreateResponse
    {
        return parent::create($params, $options);
    }

    /**
     * Retrieves the current status and result of a video editing task.
     */
    public function get(string $id, ?RequestOptions $options = null): VideoTaskResponse
    {
        $response = parent::get($id, $options);

        /** @var VideoTaskResponse $response */
        return $response;
    }

    /**
     * Submits a video editing task and polls until it completes or fails.
     *
     * @param array{
     *   model: string,
     *   prompt?: string,
     *   source_video_url?: string,
     *   source_video_urls?: list<string>,
     *   aspect_ratio?: string,
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
        return new self($http, '/api/v1/wan/edit_video', 'wan/edit-video', VideoTaskResponse::class, CompletedVideoTaskResponse::class, Types::EDIT_VIDEO_MODELS, 'edit-video', VideoTaskResponse::class, CompletedVideoTaskResponse::class);
    }
}
