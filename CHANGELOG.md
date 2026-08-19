# Changelog

All notable changes to this package are documented here. This project adheres to
[Semantic Versioning](https://semver.org/) and
[Keep a Changelog](https://keepachangelog.com/).

## [Unreleased]

## [1.2.0] - 2026-08-20

### Added
- Laravel 13 support: `illuminate/console` and `illuminate/support` widened to
  `^11.0 || ^12.0 || ^13.0`, and `pestphp/pest` / `pestphp/pest-plugin-laravel`
  to `^4.0 || ^5.0`. Pest 5 requires PHPUnit 13, so the old `^4.0` pin made this
  package uninstallable in a Laravel 13 app that had adopted Pest 5.
- Verified by installing into a Laravel 13.26.1 / PHP 8.4 application: resolves
  to Pest 5.1.1, Larastan 3.10, Pint 1.30, Collision 8.9, Boost 2.5, and the
  consuming app's suite passes. `larastan/larastan` ^3.0, `laravel/pint` ^1.25,
  `nunomaduro/collision` ^8.8, `laravel/boost` ^2.0 and `laravel/pail` ^1.2 all
  already allowed their Laravel 13-compatible releases, so no other constraint
  needed widening.

### Note
- This lifts the development-only Laravel 12 cap that
  `csatf/laravel-salesforce-connector` v0.2.0 documented: packages that take
  devtools as a dev dependency can now resolve their own test environments on
  Laravel 13.

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
