# Changelog

All notable changes to this package are documented here. This project adheres to
[Semantic Versioning](https://semver.org/) and
[Keep a Changelog](https://keepachangelog.com/).

## [Unreleased]

### Added
- Initial scaffold: `require-dev` baseline (Pint, Pest + Laravel plugin,
  Larastan, Pail, Collision, Mockery, Faker).
- Shared `pint.json` and PHPStan/Larastan baseline (`phpstan.neon`).
- `csatf:devtools:install` command and `vendor:publish --tag=csatf-devtools`
  to drop the shared config into a consuming app.
