<?php
/**
 * Unit tests for the Theme bootstrapper.
 *
 * @package WPStarterTheme\Tests
 */

declare(strict_types=1);

namespace WPStarterTheme\Tests;

use Brain\Monkey;
use Brain\Monkey\Functions;
use PHPUnit\Framework\TestCase;
use WPStarterTheme\Theme;
use WPStarterTheme\Providers\AssetProvider;
use WPStarterTheme\Providers\MenuProvider;
use WPStarterTheme\Providers\PatternProvider;
use WPStarterTheme\Providers\SupportProvider;
use WPStarterTheme\Providers\CustomizerProvider;

/**
 * @covers \WPStarterTheme\Theme
 */
class ThemeTest extends TestCase {

    protected function setUp(): void {
        parent::setUp();
        Monkey\setUp();

        // Stub WordPress functions called during provider registration.
        Functions\stubs( [
            'add_action'  => null,
            'add_filter'  => null,
        ] );
    }

    protected function tearDown(): void {
        Monkey\tearDown();
        Theme::reset();
        parent::tearDown();
    }

    public function test_init_registers_all_providers(): void {
        Theme::init();

        $this->assertNotNull( Theme::get_provider( AssetProvider::class ) );
        $this->assertNotNull( Theme::get_provider( MenuProvider::class ) );
        $this->assertNotNull( Theme::get_provider( PatternProvider::class ) );
        $this->assertNotNull( Theme::get_provider( SupportProvider::class ) );
        $this->assertNotNull( Theme::get_provider( CustomizerProvider::class ) );
    }

    public function test_init_is_idempotent(): void {
        Theme::init();
        Theme::init(); // Must not throw or double-register.

        // Provider is still retrievable after second call.
        $this->assertInstanceOf( AssetProvider::class, Theme::get_provider( AssetProvider::class ) );
    }

    public function test_get_provider_returns_null_for_unknown_class(): void {
        Theme::init();
        $this->assertNull( Theme::get_provider( \stdClass::class ) );
    }

    public function test_reset_clears_state(): void {
        Theme::init();
        Theme::reset();

        $this->assertNull( Theme::get_provider( AssetProvider::class ) );
    }
}
