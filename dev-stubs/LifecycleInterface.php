<?php

declare(strict_types=1);

namespace Phlix\Shared\Plugin;

use Psr\Container\ContainerInterface;

interface LifecycleInterface
{
    public function onEnable(ContainerInterface $container): void;

    public function onDisable(): void;

    /**
     * @return array<class-string, string|callable>
     */
    public function subscribedEvents(): array;
}
