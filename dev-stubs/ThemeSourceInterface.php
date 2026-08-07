<?php

declare(strict_types=1);

namespace Phlix\Theming;

interface ThemeSourceInterface
{
    public function themeSourceName(): string;

    /**
     * @return list<array<array-key, mixed>>
     */
    public function providedThemes(): array;
}
