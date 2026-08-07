<?php

declare(strict_types=1);

namespace Phlix\PhantomMint;

use Phlix\Shared\Plugin\LifecycleInterface;
use Phlix\Theming\ThemeSourceInterface;
use Psr\Container\ContainerInterface;

final class PhantomMintPlugin implements LifecycleInterface, ThemeSourceInterface
{
    public const SOURCE_NAME = 'phantom-mint';

    public function onEnable(ContainerInterface $container): void
    {
    }

    public function onDisable(): void
    {
    }

    public function subscribedEvents(): array
    {
        return [];
    }

    public function themeSourceName(): string
    {
        return self::SOURCE_NAME;
    }

    public function providedThemes(): array
    {
        return [
            [
                'id'      => 'phantom-mint',
                'name'    => 'Phantom Mint',
                'dark'    => true,
                'extends' => 'midnight',
                'tokens'  => [
                    '--accent'             => '#00e5a0',
                    '--accent-hover'       => '#33ebb3',
                    '--accent-active'      => '#00c289',
                    '--accent-soft'        => 'rgba(0, 229, 160, 0.12)',
                    '--accent-ring'        => 'rgba(0, 229, 160, 0.45)',
                    '--accent-text'        => '#001a12',
                    '--bg'                 => '#03080a',
                    '--surface'            => '#081113',
                    '--surface-2'          => '#0f1a1d',
                    '--surface-3'          => '#162325',
                    '--surface-glass'      => 'rgba(8, 17, 19, 0.65)',
                    '--surface-glass-strong' => 'rgba(3, 8, 10, 0.88)',
                    '--text'               => '#e8f4f0',
                    '--text-muted'         => '#8fa8a4',
                    '--text-subtle'        => '#5a706a',
                    '--text-faint'         => '#374a47',
                    '--text-on-accent'     => '#001a12',
                    '--border'             => '#1a2d2b',
                    '--border-subtle'      => '#0f1d1b',
                    '--border-strong'      => '#2a4542',
                    '--grain-opacity'      => '0.03',
                    '--vignette'           => 'rgba(0, 20, 15, 0.7)',
                    '--ambient'            => 'rgba(0, 229, 160, 0.18)',
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
