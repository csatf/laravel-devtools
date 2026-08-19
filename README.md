# csatf/laravel-devtools

A single `require-dev` dependency that standardises the development-tooling
baseline across CSATF Laravel applications: it pins the tools every app uses and
ships the shared **Pint** and **PHPStan/Larastan** configuration.

Adopting it replaces ~8 individual `require-dev` entries (and the per-repo style
and static-analysis config drift) with one line.

> This package is **dev-only**. Its service provider is never loaded in a
> `--no-dev` production build.

## What it pins

| Tool | Purpose |
|------|---------|
| `laravel/pint` | Code style (config shipped here) |
| `larastan/larastan` | Static analysis (baseline shipped here) |
| `pestphp/pest` + `pest-plugin-laravel` | Test runner |
| `laravel/pail` | Tailing logs in dev |
| `laravel/pao` | Agent-optimized output for test runs |
| `laravel/sail` | Docker dev environment |
| `laravel/boost` | AI-assisted dev tooling (MCP server + guidelines) |
| `nunomaduro/collision` | Pretty CLI errors |
| `mockery/mockery` | Mocking |
| `fakerphp/faker` | Test data |

> **`laravel/pao` sets this package's floor.** Every `pao` 1.x declares
> `conflict: laravel/framework <12.0.0`, plus `pest >=4.6.3` and
> `collision >=8.9.3`, and requires PHP 8.3. Pinning it is therefore what drops
> Laravel 11 and raises the Pest floor — no combination of versions supports
> both `pao` and Laravel 11. Apps still on Laravel 11 should stay on devtools
> `^1.2`.

> **Boost is pinned here, but configured per app.** This package only pins the
> version; each app still runs `php artisan boost:install` once, which generates
> app-specific AI guidelines (from that app's installed packages) and writes the
> MCP/editor config into the project. Standard across CSATF since we develop with
> Claude Code; harmless elsewhere as it is `require-dev` and never loaded in prod.

## Requirements

PHP 8.3+, Laravel 12 / 13. Pest 4.6.3+ or 5.

Constraints are kept as wide as each tool genuinely allows, so that adopting
this package never forces an app's Laravel version. Where a range is narrow it
is because a pinned tool requires it, not because a newer major was picked by
default — see the `pao` note above.

## Install

1. Add the repository to the consuming app's `composer.json` (until it's on a
   private Packagist):

   ```json
   "repositories": [
       { "type": "vcs", "url": "git@github.com:csatf/laravel-devtools.git" }
   ]
   ```

2. Require it (dev only) and run the installer:

   ```sh
   composer require --dev csatf/laravel-devtools
   php artisan csatf:devtools:install
   ```

   The installer writes `pint.json` and a root `phpstan.neon` (which `includes`
   the baseline shipped here). Re-run with `--force` to overwrite. You can also
   publish without the command: `php artisan vendor:publish --tag=csatf-devtools`.

3. Remove the now-redundant individual tools from the app's `require-dev`.

## Usage

```sh
vendor/bin/pint              # format
vendor/bin/pint --test       # check only (CI)
vendor/bin/phpstan analyse   # static analysis
vendor/bin/pest              # tests
```

## PHPStan

The app's root `phpstan.neon` includes the baseline from this package and only
declares its own `paths`:

```neon
includes:
    - vendor/larastan/larastan/extension.neon
    - vendor/csatf/laravel-devtools/phpstan.neon

parameters:
    paths:
        - app
```

The baseline sets `level: 5`. Raise it per-app over time; don't lower it.

## Versioning

SemVer, tag-driven. A change that makes an app's `pint --test` or `phpstan`
run newly fail is treated as breaking and bumps the major. Pin with a caret
(`^1.0`) in consuming apps.

## Conventions this package models

It is also the reference template for CSATF Composer packages: a `Csatf\`
PSR-4 namespace, Laravel package auto-discovery (`extra.laravel.providers`),
publishable config via a service provider plus a `csatf:*` install command, and
SemVer tags. New `csatf/*` packages should follow the same shape.
