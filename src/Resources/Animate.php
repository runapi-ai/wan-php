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
 * Transfers motion from a reference video onto a subject in a source image. Two model variants are available: animate-move (keeps the original subject, applies motion) and animate-replace (swaps the subject with the reference video's subject).
 */
readonly class Animate extends TypedConfiguredResource
{
    /**
     * Submits a motion-transfer animation task and returns immediately with the task id.
     *
     * @param array{
     *   model: string,
     *   source_image_url?: string,
     *   reference_video_url?: string,
     *   output_resolution?: string,
     *   callback_url?: string
     * } $params
     */
    public function create(array $params, ?RequestOptions $options = null): TaskCreateResponse
    {
        return parent::create($params, $options);
    }

    /**
     * Retrieves the current status and result of an animation task.
     */
    public function get(string $id, ?RequestOptions $options = null): VideoTaskResponse
    {
        $response = parent::get($id, $options);

        /** @var VideoTaskResponse $response */
        return $response;
    }

    /**
     * Submits an animation task and polls until it completes or fails.
     *
     * @param array{
     *   model: string,
     *   source_image_url?: string,
     *   reference_video_url?: string,
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
        return new self($http, '/api/v1/wan/animate', 'wan/animate', VideoTaskResponse::class, CompletedVideoTaskResponse::class, Types::ANIMATE_MODELS, 'animate', VideoTaskResponse::class, CompletedVideoTaskResponse::class);
    }
}
