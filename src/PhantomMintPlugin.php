<?php

/**
 * Phlix Phantom Mint plugin: a ui-theme provider.
 *
 * @copyright 2026 Joe Huss <detain@interserver.net>
 * @license   MIT
 */

declare(strict_types=1);

namespace Phlix\PhantomMint;

use Phlix\Shared\Plugin\LifecycleInterface;
use Phlix\Theming\ThemeSourceInterface;
use Psr\Container\ContainerInterface;

/**
 * Phantom Mint — a deep-sea mint theme with bioluminescent teal accents.
 *
 * This theme extends the built-in `midnight` base and contributes a single
 * `phantom-mint` theme with a distinctive mint accent ramp, near-black
 * green-tinted surfaces, and aquatic atmosphere effects.
 *
 * ## Theme Design
 *
 * The Phantom Mint theme features:
 * - Vibrant mint accent (#00e5a0) with lighter hover and deeper active states
 * - Near-black surfaces with a green undertone for deep-water depth
 * - Cool mint-tinted text ramp for readable secondary copy
 * - Subtle grain and a dark teal vignette for atmosphere
 * - Ambient mint glow (`--ambient`) echoing bioluminescence
 *
 * Every token value below is a literal the host grammar accepts — no `var()`
 * chains, no CSS constructs. The paired WCAG contract for the accent ramp is
 * pinned by `tests/TokenContrastTest.php`.
 *
 * @package Phlix\PhantomMint
 * @since 1.0.0
 */
final class PhantomMintPlugin implements LifecycleInterface, ThemeSourceInterface
{
    /**
     * Canonical provenance key for this source.
     *
     * The host keys the registry's provenance map on this, so re-enabling
     * REPLACES this plugin's themes instead of duplicating them, and disabling
     * removes exactly this id. Keep it constant across versions.
     */
    public const SOURCE_NAME = 'phantom-mint';

    /**
     * Nothing to do — the host registers the themes off the `instanceof`.
     *
     * @param ContainerInterface $container The host container (unused).
     */
    public function onEnable(ContainerInterface $container): void
    {
    }

    /**
     * Nothing to do — the host deregisters this source by name on disable.
     */
    public function onDisable(): void
    {
    }

    /**
     * A theme plugin subscribes to no events.
     *
     * @return array<class-string, string> Always empty.
     */
    public function subscribedEvents(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function themeSourceName(): string
    {
        return self::SOURCE_NAME;
    }

    /**
     * @inheritDoc
     *
     * @return list<array<array-key, mixed>>
     */
    public function providedThemes(): array
    {
        return [
            [
                'id'      => 'phantom-mint',
                'name'    => 'Phantom Mint',
                'dark'    => true,
                // A BUILT-IN base: only the SPA can resolve this one.
                'extends' => 'midnight',
                'tokens'  => [
                    // Accent ramp — mint tones with lighter hover / deeper active.
                    // --accent-text is the accent mint AS foreground text, AA on
                    // dark surfaces (wordmark dot, initials, selected-state text).
                    '--accent'             => '#00e5a0',
                    '--accent-hover'       => '#33ebb3',
                    '--accent-active'      => '#00c289',
                    '--accent-soft'        => 'rgba(0, 229, 160, 0.12)',
                    '--accent-ring'        => 'rgba(0, 229, 160, 0.55)',
                    '--accent-text'        => '#00e5a0',

                    // Background + elevation stack — near-black green undertones.
                    '--bg'                 => '#03080a',
                    '--surface'            => '#081113',
                    '--surface-2'          => '#0f1a1d',
                    '--surface-3'          => '#162325',
                    '--surface-glass'      => 'rgba(8, 17, 19, 0.65)',
                    '--surface-glass-strong' => 'rgba(3, 8, 10, 0.88)',

                    // Text ramp — cool mint-tinted whites down to the faint tier.
                    // KNOWN LIMITATION (measured): --text-faint #374a47 lands at
                    // 2.14:1 on --bg and 2.03:1 on --surface — below the 4.5:1
                    // AA floor for body copy. The shipped SPA reads it via
                    // var(--text-faint) for hint/disabled copy (phlix-ui
                    // LoginForm, SyncPlayModal). The base it extends is the same
                    // tier (midnight ships #463d33 at 1.98:1 on #000000), so
                    // lifting mint alone breaks family parity — the value move
                    // is an owner-gated family decision; see
                    // theme-phantom-mint__webux.md MINOR-5. Do not silently
                    // re-tune it here.
                    '--text'               => '#e8f4f0',
                    '--text-muted'         => '#8fa8a4',
                    '--text-subtle'        => '#77928c',
                    '--text-faint'         => '#374a47',
                    '--text-on-accent'     => '#001a12',

                    // Borders — mint-tinted, from default to emphasized dividers.
                    '--border'             => '#1a2d2b',
                    '--border-subtle'      => '#0f1d1b',
                    '--border-strong'      => '#2a4542',

                    // Atmosphere — grain, vignette, ambient glow.
                    '--grain-opacity'      => '0.03',
                    '--vignette'           => 'rgba(0, 20, 15, 0.7)',
                    '--ambient'            => 'rgba(0, 229, 160, 0.18)',

                    // Legacy `--color-*` aliases — only the ones the shipped SPA
                    // still reads (PhotoView/Albums pages, admin WebhookLogs).
                    // Each duplicates its modern twin above ON PURPOSE: raise
                    // --bg and you must raise --color-bg in the same edit.
                    '--color-bg'           => '#03080a',
                    '--color-surface'      => '#081113',
                    '--color-text'         => '#e8f4f0',
                    '--color-text-muted'   => '#8fa8a4',
                    '--color-border'       => '#1a2d2b',
                ],
            ],
        ];
    }
}
