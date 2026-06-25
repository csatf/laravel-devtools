# Changelog

All notable changes to this package are documented here. This project adheres to
[Semantic Versioning](https://semver.org/) and
[Keep a Changelog](https://keepachangelog.com/).

## [Unreleased]

## [1.1.0] - 2026-06-25

### Added
- Pin `laravel/boost` (^2.0) in the dev baseline. AI-assisted dev tooling is now
  a shared standard since CSATF develops with Claude Code. Apps still run
  `php artisan boost:install` once to generate per-app guidelines and MCP config.

## [1.0.0] - 2026-06-25

### Added
- Initial scaffold: `require-dev` baseline (Pint, Pest + Laravel plugin,
  Larastan, Pail, Collision, Mockery, Faker).
- Shared `pint.json` and PHPStan/Larastan baseline (`phpstan.neon`).
- `csatf:devtools:install` command and `vendor:publish --tag=csatf-devtools`
  to drop the shared config into a consuming app.
