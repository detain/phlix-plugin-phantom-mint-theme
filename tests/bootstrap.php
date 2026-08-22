<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

if (!interface_exists(\Phlix\Shared\Plugin\LifecycleInterface::class)) {
    require __DIR__ . '/../dev-stubs/LifecycleInterface.php';
}

if (!interface_exists(\Phlix\Theming\ThemeSourceInterface::class)) {
    require __DIR__ . '/../dev-stubs/ThemeSourceInterface.php';
}
