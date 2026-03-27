<?php
/**
 * PHPUnit bootstrap for wp-starter-plugin tests.
 *
 * Uses Brain\Monkey for unit-testable WordPress function mocking.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Brain\Monkey;

// Stub WordPress classes not available in unit-test context.
if ( ! class_exists( 'Walker' ) ) {
    class Walker {} // phpcs:ignore
}
if ( ! class_exists( 'Walker_Nav_Menu' ) ) {
    class Walker_Nav_Menu extends Walker {} // phpcs:ignore
}

// Bootstrap Brain\Monkey globally.
\PHPUnit\Framework\TestCase::class;
