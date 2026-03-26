<?php
/**
 * Main Theme bootstrapper.
 *
 * @package WPStarterTheme
 */

declare(strict_types=1);

namespace WPStarterTheme;

use WPStarterTheme\Providers\AssetProvider;
use WPStarterTheme\Providers\CustomizerProvider;
use WPStarterTheme\Providers\MenuProvider;
use WPStarterTheme\Providers\PatternProvider;
use WPStarterTheme\Providers\SupportProvider;

/**
 * Central theme bootstrapper.
 *
 * Instantiates and registers all service providers in the correct order.
 * Each provider is responsible for its own hook registration; this class
 * only needs to call register() on each one.
 */
final class Theme {

    /**
     * Registered service providers.
     *
     * @var array<int, object>
     */
    private static array $providers = [];

    /**
     * Whether the theme has been initialised.
     */
    private static bool $initialised = false;

    /**
     * Boot all service providers.
     *
     * Safe to call multiple times — subsequent calls are no-ops.
     */
    public static function init(): void {
        if ( self::$initialised ) {
            return;
        }

        self::$initialised = true;

        self::$providers = [
            new SupportProvider(),
            new AssetProvider(),
            new MenuProvider(),
            new PatternProvider(),
            new CustomizerProvider(),
        ];

        foreach ( self::$providers as $provider ) {
            $provider->register();
        }
    }

    /**
     * Retrieve a registered provider by class name (useful in tests).
     *
     * @template T
     * @param class-string<T> $class Fully-qualified class name.
     * @return T|null
     */
    public static function get_provider( string $class ): ?object {
        foreach ( self::$providers as $provider ) {
            if ( $provider instanceof $class ) {
                return $provider;
            }
        }
        return null;
    }

    /**
     * Reset theme state (test helper — not for production use).
     *
     * @internal
     */
    public static function reset(): void {
        self::$providers  = [];
        self::$initialised = false;
    }
}
