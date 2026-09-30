# Changelog

## [v0.2.0](https://github.com/runapi-ai/wan-php/releases/tag/v0.2.0) - 2026-09-30

### Changed
- Send request parameters to the service without local validation. Model ids and parameter values the service supports work without an SDK upgrade; static types and enum constants remain for completion.
  Migration: Invalid parameters now throw `ValidationException` built from the service's 400 response, including its status and message, instead of a `ValidationException` thrown locally before the request.


## [v0.1.1](https://github.com/runapi-ai/wan-php/releases/tag/v0.1.1) - 2026-08-07

### Added
- Add the optional multi_shots field to WAN 2.6 text-to-video, image-to-video, and video editing requests.


## [v0.1.0](https://github.com/runapi-ai/wan-php/releases/tag/v0.1.0) - 2026-06-25

### Added
- Publish the first RunAPI PHP Composer package release for `runapi-ai/wan`.
- Include typed PHP client resources, package README, Apache-2.0 license, and Composer CI.
