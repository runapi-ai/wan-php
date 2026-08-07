<?php

declare(strict_types=1);

namespace RunApi\Wan\Tests\Unit;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use RunApi\Core\ClientOptions;
use RunApi\Core\Tests\Fixtures\QueueHttpClient;
use RunApi\Wan\Models\CompletedVideoTaskResponse;
use RunApi\Wan\Resources\Animate;
use RunApi\Wan\Resources\TextToImage;
use RunApi\Wan\Resources\TextToVideo;
use RunApi\Wan\WanClient;

final class WanClientTest extends TestCase
{
    public function testExposesTypedResources(): void
    {
        $client = new WanClient(new ClientOptions(apiKey: 'k', httpClient: new QueueHttpClient([]), maxRetries: 0));

        self::assertInstanceOf(TextToVideo::class, $client->textToVideo);
        self::assertInstanceOf(TextToImage::class, $client->textToImage);
        self::assertInstanceOf(Animate::class, $client->animate);
    }

    public function testVideoAndImageResourcesPostToCorrectPaths(): void
    {
        $transport = new QueueHttpClient([
            new Response(200, [], '{"id":"video_task"}'),
            new Response(200, [], '{"id":"image_task"}'),
        ]);
        $client = new WanClient(new ClientOptions(apiKey: 'k', httpClient: $transport, maxRetries: 0));

        self::assertSame('video_task', $client->textToVideo->create([
            'model' => 'wan-2.6-text-to-video',
            'prompt' => 'A mountain landscape',
            'multi_shots' => false,
        ])->id);
        self::assertSame('image_task', $client->textToImage->create([
            'model' => 'wan-2.7-image',
            'prompt' => 'A logo design',
        ])->id);

        self::assertSame('/api/v1/wan/text_to_video', $transport->requests[0]->getUri()->getPath());
        self::assertSame(
            ['model' => 'wan-2.6-text-to-video', 'prompt' => 'A mountain landscape', 'multi_shots' => false],
            json_decode((string) $transport->requests[0]->getBody(), true),
        );
        self::assertSame('/api/v1/wan/text_to_image', $transport->requests[1]->getUri()->getPath());
    }

    public function testTextToVideoRunReturnsTypedCompletedResponse(): void
    {
        $transport = new QueueHttpClient([
            new Response(200, [], '{"id":"video_task"}'),
            new Response(200, [], '{"id":"video_task","status":"completed","videos":[{"url":"https://file.runapi.ai/video.mp4"}]}'),
        ]);
        $client = new WanClient(new ClientOptions(apiKey: 'k', httpClient: $transport, maxRetries: 0));

        $result = $client->textToVideo->run([
            'model' => 'wan-2.7-text-to-video',
            'prompt' => 'A mountain landscape',
        ]);

        self::assertInstanceOf(CompletedVideoTaskResponse::class, $result);
        self::assertSame('https://file.runapi.ai/video.mp4', $result->videos[0]->url);
    }
}
