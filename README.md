# Wan PHP SDK for RunAPI

[![Packagist](https://img.shields.io/packagist/v/runapi-ai/wan)](https://packagist.org/packages/runapi-ai/wan)
[![License](https://img.shields.io/github/license/runapi-ai/wan-php)](https://github.com/runapi-ai/wan-php/blob/main/LICENSE)

The Wan PHP SDK is the Composer package for Wan on RunAPI. Use it when your PHP application needs associative-array request bodies, task status lookup, polling helpers, file helpers, and consistent RunAPI errors.

## Install

```bash
composer require runapi-ai/wan
```

## Quick start

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use RunApi\Wan\WanClient;

$client = new WanClient(); // reads RUNAPI_API_KEY

$task = $client->textToVideo->create([
    'model' => 'wan-2.7-text-to-video',
    'prompt' => 'A scenic mountain landscape',
]);

$status = $client->textToVideo->get($task->id);

$result = $client->textToVideo->run([
    'model' => 'wan-2.7-text-to-video',
    'prompt' => 'A wide aerial shot over a snowy mountain ridge',
]);

echo $result->videos[0]->url . PHP_EOL;
```

Use `create()` to submit a task and return quickly, `get()` to fetch the latest task state, and `run()` when a script should create and poll until completion. In web request handlers, prefer `create()` plus webhook or later `get()` polling so a worker is not held open.

Returned file URLs are temporary. Download and store generated files in your own durable storage within the retention window.

All SDK exceptions inherit from `RunApi\Core\Errors\RunApiException`, including validation, authentication, rate limit, task failure, and task timeout errors.

## Links

- Model page: https://runapi.ai/models/wan
- SDK docs: https://runapi.ai/docs#sdk-wan
- Product docs: https://runapi.ai/docs#wan
- Pricing and rate limits: https://runapi.ai/models/wan/2.2-a14b-text-to-video-turbo
- Full catalog: https://runapi.ai/models
- GitHub repository: https://github.com/runapi-ai/wan-php
- Multi-language SDK repository: https://github.com/runapi-ai/wan-sdk

## License

Licensed under the Apache License, Version 2.0.
