# Phantom Mint for Phlix

A deep-sea mint UI theme for Phlix, built on the midnight base theme.

## Overview

Phantom Mint features a dark, aquatic aesthetic with teal-mint accent colors that evoke the bioluminescence of deep ocean waters. The theme extends the built-in midnight base to inherit its robust foundation while adding a distinctive mint-forward visual identity.

## Theme Details

- **Theme ID**: `phantom-mint`
- **Theme Name**: Phantom Mint
- **Type**: Dark UI Theme
- **Extends**: `midnight` (built-in base)
- **Author**: Detain
- **License**: MIT

## Color Palette

### Accent Colors
- **Primary Accent**: `#00e5a0` — Vibrant mint green
- **Accent Hover**: `#33ebb3` — Lighter mint on hover
- **Accent Active**: `#00c289` — Deeper mint when pressed
- **Accent Soft**: `rgba(0, 229, 160, 0.12)` — Subtle mint backgrounds
- **Accent Ring**: `rgba(0, 229, 160, 0.55)` — Focus ring color
- **Accent Text**: `#00e5a0` — the accent mint AS foreground text/icon, AA (≥4.5:1) on dark surfaces (wordmark dot, avatar initials, selected-state text)

### Background & Surface
- **Background**: `#03080a` — Near-black with green undertone
- **Surface**: `#081113` — Elevated surface color
- **Surface 2**: `#0f1a1d` — Higher elevation
- **Surface 3**: `#162325` — Highest elevation
- **Surface Glass**: `rgba(8, 17, 19, 0.65)` — Glass panel overlay
- **Surface Glass Strong**: `rgba(3, 8, 10, 0.88)` — Strong glass effect

### Text Colors
- **Primary Text**: `#e8f4f0` — High contrast mint-tinted white
- **Muted Text**: `#8fa8a4` — Secondary text
- **Subtle Text**: `#77928c` — Tertiary text
- **Faint Text**: `#374a47` — Disabled/hint text
- **On Accent**: `#001a12` — dark ink painted on accent-filled surfaces (`--text-on-accent`; a different role from `--accent-text`, which is mint-on-dark)

### Border Colors
- **Border**: `#1a2d2b` — Default border
- **Border Subtle**: `#0f1d1b` — Subtle dividers
- **Border Strong**: `#2a4542` — Emphasized borders

### Effects
- **Grain Opacity**: `0.03` — Subtle film grain overlay
- **Vignette**: `rgba(0, 20, 15, 0.7)` — Edge darkening
- **Ambient**: `rgba(0, 229, 160, 0.18)` — Ambient glow effect

### Legacy `--color-*` aliases

Five tokens above are deliberately duplicated under their legacy `--color-*`
alias names. The alias family predates the modern tokens and the shipped SPA
still reads it — `var()` consumers live in the PhotoView/PhotoAlbum pages and
the admin WebhookLogs page:

| Alias | Value | Modern twin |
| --- | --- | --- |
| `--color-bg` | `#03080a` | `--bg` |
| `--color-surface` | `#081113` | `--surface` |
| `--color-text` | `#e8f4f0` | `--text` |
| `--color-text-muted` | `#8fa8a4` | `--text-muted` |
| `--color-border` | `#1a2d2b` | `--border` |

These duplicates are load-bearing, not decorative: if you raise `--bg` you
must raise `--color-bg` in the same edit, or the un-migrated components keep
the old color underneath the new theme. The four status aliases
(`--color-error*` and friends) are omitted on purpose — this theme overrides no
status colors, so the aliases correctly fall through to the midnight base. The
remaining thirteen `--color-*` names on the allowlist have no `var()`
consumers at all; setting them would be a no-op, so they stay omitted.

## Installation

### The supported route: the plugin catalog

The Phlix server installs plugins from a **catalog** (`plugins.json`). A catalog
entry pins an exact commit (`ref`) and the sha256 of that commit's tarball
(`artifactSha256`), and the server verifies those bytes before it extracts
anything. Without a pin, `PluginLoader::install()` refuses outright — that is a
deliberate default-deny, not a bug to work around.

**Admin UI** — *Admin → Plugins* (`/app/admin/plugins`), find **Phantom Mint
Theme**, press **Install**, then flip its switch to **enable** it.

**CLI** — from the server root, pass the **repository URL**, not the plugin
name (the URL is what gets rewritten to the pinned tarball):

```bash
php bin/phlix plugin:install https://github.com/detain/phlix-plugin-phantom-mint-theme
php bin/phlix plugin:enable  phlix-plugin-phantom-mint-theme
```

While iterating on a local fork (no catalog entry yet), build an archive and
install it over `file://`, which is exempt from the pin requirement because the
bytes are already yours:

```bash
tar --exclude=vendor --exclude=.git -czf /tmp/phantom-mint.tar.gz phlix-plugin-phantom-mint-theme/
php bin/phlix plugin:install file:///tmp/phantom-mint.tar.gz
php bin/phlix plugin:enable  phlix-plugin-phantom-mint-theme
```

### What does **not** work

`composer require detain/phlix-plugin-phantom-mint-theme` into the server, or
cloning this repository into the plugins directory, does not register anything —
the plugin loader installs catalog-pinned archives or local tarballs, never an
ambient vendor checkout or a bare directory.

### Install, enable, and selection are three different acts

Installing downloads and stages the plugin. **Enabling** it is what registers
the theme: `PluginLoader::enable()` finds the `ThemeSourceInterface` on the
entry class and contributes the `phantom-mint` theme id. Choosing the theme is
a **per-user preference**, not an admin action — each user picks *Phantom Mint*
under **Settings → Appearance**. None of the three steps implies the next.

## Requirements

- PHP 8.3 or higher
- Phlix server 0.44.0 or higher
- PSR Container 1.1 or 2.0

## Development

### Running Tests

```bash
composer install
./vendor/bin/phpunit
```

### Code Quality

```bash
# Static analysis with PHPStan (level 9 over src/ and scripts/; dev-stubs/
# scanned for the host interfaces, zero ignores)
./vendor/bin/phpstan analyse

# Coding standards with PHPCS
./vendor/bin/phpcs

# Fix coding standards automatically
./vendor/bin/phpcbf
```

### CI Pipeline

The single GitHub Actions workflow (`.github/workflows/test.yml`) runs:
- PHPUnit tests on PHP 8.3 and 8.4, with coverage (pcov → Codacy)
- PHPStan static analysis at level 9
- PHPCS code style checking
- Security Audit (`composer-audit`): the whole committed lock — runtime *and*
  development dependencies — checked against the Packagist advisory corpus by
  `scripts/security-audit-check.php`, pinned by its guard test
  `tests/SecurityAuditCheckTest.php`

## Theme Rules

1. **Token Keys**: All token keys must be on the Phlix theme token allowlist
2. **Token Values**: Must be literal values — hex colors, rgb/rgba/hsl/hsla with numeric arguments, bare numbers, `transparent`, or `currentColor`
3. **Forbidden Values**: a token value must be one literal, and must not
   contain any of:
   - a `var()` or `url()` reference,
   - a `;`, `{`, `}`, or backslash,
   - a newline, tab, or CSS comment.

   The host parser accepts only complete literals per value, so these are
   rejected rather than stripped — the whole payload fails to register.

## File Structure

```
phlix-plugin-phantom-mint-theme/
├── src/
│   └── PhantomMintPlugin.php       # Main plugin class
├── dev-stubs/
│   ├── LifecycleInterface.php     # Host interface stub
│   └── ThemeSourceInterface.php   # Host interface stub
├── tests/
│   ├── bootstrap.php               # Test bootstrap (loads dev-stubs when host absent)
│   ├── PhantomMintPluginTest.php   # Plugin tests
│   ├── SecurityAuditCheckTest.php  # S440 anti-neutering guard for the audit gate
│   └── TokenContrastTest.php       # WCAG contrast contract law for the palette
├── scripts/
│   └── security-audit-check.php    # Whole-lock audit gate (CI `composer-audit`)
├── .github/
│   └── workflows/
│       └── test.yml                # CI workflow
├── composer.json                  # Package definition
├── composer.lock                  # Locked dependency versions
├── plugin.json                    # Plugin manifest
├── phpunit.xml                    # PHPUnit config
├── phpstan.neon                   # PHPStan config
├── phpcs.xml                      # PHPCS config
├── README.md                      # This file
└── LICENSE                        # MIT license
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Run the test suite
5. Submit a pull request

## License

MIT License — see [LICENSE](LICENSE) for details.
