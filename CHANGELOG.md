# Changelog

## [Unreleased]

### Changed
- Dev toolchain upgraded: PHPUnit 10 -> 12.5 (PHP >=8.3 floor unchanged; PHPUnit 13 needs PHP 8.4+), PHPStan 2.3.5. Test doubles without expectations now use `createStub`; the audit-gate guard test strings mirror the pluralised gate messages.
- GitHub Actions confirmed at latest majors/pins (checkout v6, setup-php 2.40.0, codacy 1.3.0). `detain/phlix-shared` git pin intentionally unchanged.
