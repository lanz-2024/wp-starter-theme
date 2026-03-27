<?php

declare(strict_types=1);

namespace WPStarterTheme\Tests\Unit;

use Brain\Monkey;
use Brain\Monkey\Functions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use WPStarterTheme\Providers\AssetProvider;

/**
 * Tests for AssetProvider (script/style enqueuing).
 */
class AssetProviderTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    protected function setUp(): void
    {
        parent::setUp();
        Monkey\setUp();
        Functions\when('get_theme_file_uri')->returnArg();
        Functions\when('get_theme_file_path')->returnArg();
        Functions\when('filemtime')->justReturn(1711512000);
    }

    protected function tearDown(): void
    {
        Monkey\tearDown();
        parent::tearDown();
    }

    public function test_register_adds_wp_enqueue_scripts_action(): void
    {
        $provider = new AssetProvider();

        // Spy that add_action is called with wp_enqueue_scripts.
        Functions\expect('add_action')
            ->atLeast()
            ->once()
            ->with('wp_enqueue_scripts', \Mockery::any());

        $provider->register();

        $this->addToAssertionCount(1);
    }

    public function test_enqueue_calls_wp_enqueue_style(): void
    {
        Functions\expect('wp_enqueue_style')
            ->once()
            ->with('wp-starter-theme', \Mockery::type('string'), [], \Mockery::any());

        Functions\when('wp_enqueue_script')->justReturn(null);
        Functions\when('wp_script_add_data')->justReturn(null);
        Functions\when('is_singular')->justReturn(false);
        Functions\when('wp_add_inline_script')->justReturn(null);

        $provider = new AssetProvider();
        $provider->enqueue();

        $this->addToAssertionCount(1);
    }
}
