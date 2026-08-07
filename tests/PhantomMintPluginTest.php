<?php

declare(strict_types=1);

namespace Phlix\PhantomMint;

use PHPUnit\Framework\TestCase;
use Phlix\Shared\Plugin\LifecycleInterface;
use Phlix\Theming\ThemeSourceInterface;
use Psr\Container\ContainerInterface;

final class PhantomMintPluginTest extends TestCase
{
    private PhantomMintPlugin $plugin;

    protected function setUp(): void
    {
        $this->plugin = new PhantomMintPlugin();
    }

    public function testImplementsLifecycleInterface(): void
    {
        $this->assertInstanceOf(LifecycleInterface::class, $this->plugin);
    }

    public function testImplementsThemeSourceInterface(): void
    {
        $this->assertInstanceOf(ThemeSourceInterface::class, $this->plugin);
    }

    public function testThemeSourceNameReturnsCorrectSlug(): void
    {
        $slug = $this->plugin->themeSourceName();

        $this->assertIsString($slug);
        $this->assertSame('phantom-mint', $slug);
        $this->assertMatchesRegularExpression('/^[a-z0-9](?:[a-z0-9._-]{0,62}[a-z0-9])?$/z', $slug);
    }

    public function testProvidedThemesReturnsArray(): void
    {
        $themes = $this->plugin->providedThemes();

        $this->assertIsArray($themes);
        $this->assertNotEmpty($themes);
    }

    public function testThemeHasRequiredFields(): void
    {
        $themes = $this->plugin->providedThemes();
        $theme = $themes[0];

        $this->assertArrayHasKey('id', $theme);
        $this->assertArrayHasKey('name', $theme);
        $this->assertArrayHasKey('dark', $theme);
        $this->assertArrayHasKey('extends', $theme);
        $this->assertArrayHasKey('tokens', $theme);
    }

    public function testThemeIdIsUnique(): void
    {
        $themes = $this->plugin->providedThemes();
        $ids = array_column($themes, 'id');

        $this->assertCount(count($ids), array_unique($ids));
    }

    public function testThemeExtendsMidnight(): void
    {
        $themes = $this->plugin->providedThemes();

        foreach ($themes as $theme) {
            $this->assertSame('midnight', $theme['extends']);
        }
    }

    public function testThemeIsDark(): void
    {
        $themes = $this->plugin->providedThemes();

        foreach ($themes as $theme) {
            $this->assertTrue($theme['dark']);
        }
    }

    public function testTokensAreAllValid(): void
    {
        $themes = $this->plugin->providedThemes();

        foreach ($themes as $theme) {
            foreach ($theme['tokens'] as $key => $value) {
                $this->assertIsString($key, 'Token key must be string');
                $this->assertIsString($value, 'Token value must be string');
                $this->assertStringStartsWith('--', $key, 'Token key must start with --');
            }
        }
    }

    public function testAccentTokenIsCorrect(): void
    {
        $themes = $this->plugin->providedThemes();
        $theme = $themes[0];

        $this->assertSame('#00e5a0', $theme['tokens']['--accent']);
    }

    public function testOnEnableDoesNotThrow(): void
    {
        $container = $this->createMock(ContainerInterface::class);

        $this->plugin->onEnable($container);
        $this->assertTrue(true);
    }

    public function testOnDisableDoesNotThrow(): void
    {
        $this->plugin->onDisable();
        $this->assertTrue(true);
    }

    public function testSubscribedEventsReturnsEmptyArray(): void
    {
        $events = $this->plugin->subscribedEvents();

        $this->assertIsArray($events);
        $this->assertEmpty($events);
    }

    public function testProvidedThemesReturnsIdenticalValuesOnRepeatedCalls(): void
    {
        $first = $this->plugin->providedThemes();
        $second = $this->plugin->providedThemes();

        $this->assertSame($first, $second);
    }
}
