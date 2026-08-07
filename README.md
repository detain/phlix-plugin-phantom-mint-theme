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
- **Accent Ring**: `rgba(0, 229, 160, 0.45)` — Focus ring color
- **Accent Text**: `#001a12` — Text color on accent backgrounds

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
- **Subtle Text**: `#5a706a` — Tertiary text
- **Faint Text**: `#374a47` — Disabled/hint text
- **On Accent**: `#001a12` — Text on accent colors

### Border Colors
- **Border**: `#1a2d2b` — Default border
- **Border Subtle**: `#0f1d1b` — Subtle dividers
- **Border Strong**: `#2a4542` — Emphasized borders

### Effects
- **Grain Opacity**: `0.03` — Subtle film grain overlay
- **Vignette**: `rgba(0, 20, 15, 0.7)` — Edge darkening
- **Ambient**: `rgba(0, 229, 160, 0.18)` — Ambient glow effect

## Installation

### Via Composer

```bash
composer require detain/phlix-plugin-phantom-mint-theme
```

### Manual Installation

1. Clone this repository into your Phlix plugins directory
2. Run `composer install` to install dependencies
3. Enable the theme in your Phlix admin panel

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
# Static analysis with PHPStan
./vendor/bin/phpstan analyse

# Coding standards with PHPCS
./vendor/bin/phpcs

# Fix coding standards automatically
./vendor/bin/phpcbf
```

### CI Pipeline

The theme includes GitHub Actions workflows for:
- PHPUnit tests on PHP 8.3 and 8.4
- PHPStan static analysis at level 9
- PHPCS code style checking
- Codacy code quality analysis

## Theme Rules

1. **Token Keys**: All token keys must be on the Phlix theme token allowlist
2. **Token Values**: Must be literal values — hex colors, rgb/rgba/hsl/hsla with numeric arguments, bare numbers, `transparent`, or `currentColor`
3. **Forbidden Values**: `var()`, `url()`, `;`, `}`, `{`, `\`, newlines, tabs, and CSS comments are not allowed in token values

## File Structure

```
phlix-plugin-phantom-mint-theme/
├── src/
│   └── PhantomMintPlugin.php       # Main plugin class
├── dev-stubs/
│   ├── LifecycleInterface.php     # Host interface stub
│   └── ThemeSourceInterface.php   # Host interface stub
├── tests/
│   ├── bootstrap.php               # Test bootstrap
│   └── PhantomMintPluginTest.php   # Plugin tests
├── .github/
│   └── workflows/
│       └── test.yml                # CI workflow
├── composer.json                  # Package definition
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
