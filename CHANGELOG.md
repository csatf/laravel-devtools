# Changelog

All notable changes to this package are documented here. This project adheres to
[Semantic Versioning](https://semver.org/) and
[Keep a Changelog](https://keepachangelog.com/).

## [Unreleased]

## [1.3.0] - 2026-08-20

### Added
- `laravel/pao` (`^1.0`) — agent-optimized output for test runs.
- `laravel/sail` (`^1.41`) — previously excluded as a per-app infrastructure
  choice; now pinned centrally. Spans Laravel 12 and 13 (`v1.67.0` allows
  `illuminate/* ^9.52.16|^10|^11|^12|^13`).

### Changed — **drops Laravel 11**
- `illuminate/console` and `illuminate/support` narrowed to `^12.0 || ^13.0`.
- `php` raised to `^8.3`.
- `pestphp/pest` raised to `^4.6.3 || ^5.0`.
- `nunomaduro/collision` raised to `^8.9.3`.

  All four are forced by `laravel/pao`, which declares
  `conflict: laravel/framework <12.0.0`, `conflict: nunomaduro/collision <8.9.3`,
  `conflict: pestphp/pest <4.6.3 || >=6.0.0`, and `require: php ^8.3` — in
  *every* published 1.x. There is no version pairing that supports both `pao`
  and Laravel 11, so pinning `pao` and keeping Laravel 11 are mutually
  exclusive.

  Existing Laravel 11 apps are not broken: Composer will not offer 1.3.0 to
  them, and they stay on 1.2.x. `completions` is the only such app and does not
  currently depend on this package.

### Verified
Resolved with `config.platform.php` pinned, against the working tree:

| Target | Result |
|---|---|
| Laravel 12 / PHP 8.3 | resolves — pest 4.7.8, pao 1.1.4, sail 1.67.0, collision 8.9.5, larastan 3.10.0 |
| Laravel 13 / PHP 8.4 | resolves — pest 4.7.0, pao 1.1.4, sail 1.67.0, collision 8.9.4, larastan 3.10.0 |
| Laravel 11 / PHP 8.3 | rejected, as intended |

`pestphp/pest-plugin-laravel` stays `^4.0 || ^5.0`: v4.1.0 covers Laravel 12 and
13, and v5 requires PHP 8.4 + Laravel 13.23, so Composer selects per environment
rather than forcing the newest.

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
