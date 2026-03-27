<?php

declare(strict_types=1);

namespace WPStarterTheme\Tests\Unit;

use Brain\Monkey;
use Brain\Monkey\Functions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use WPStarterTheme\Walkers\MegaMenuWalker;

/**
 * Tests for MegaMenuWalker — custom nav walker with mega-menu support.
 */
class MegaMenuWalkerTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    protected function setUp(): void
    {
        parent::setUp();
        Monkey\setUp();
    }

    protected function tearDown(): void
    {
        Monkey\tearDown();
        parent::tearDown();
    }

    public function test_walker_extends_wp_nav_menu_walker(): void
    {
        $walker = new MegaMenuWalker();

        $this->assertInstanceOf(\Walker_Nav_Menu::class, $walker);
    }

    public function test_walker_instantiates_without_error(): void
    {
        $walker = new MegaMenuWalker();

        $this->assertNotNull($walker);
    }
}
