<?php
/**
 * Custom range slider Customizer control.
 *
 * @package WPStarterTheme\Customizer\Controls
 */

declare(strict_types=1);

namespace WPStarterTheme\Customizer\Controls;

use WP_Customize_Control;

/**
 * Renders a native HTML range input inside the Customizer.
 *
 * Usage:
 *   $wp_customize->add_control(
 *       new RangeControl( $wp_customize, 'my_setting', [
 *           'label'   => 'My Range',
 *           'section' => 'my_section',
 *           'min'     => 0,
 *           'max'     => 100,
 *           'step'    => 1,
 *       ])
 *   );
 */
class RangeControl extends WP_Customize_Control {

	/**
	 * Control type identifier.
	 *
	 * @var string
	 */
	public $type = 'range';

	/**
	 * Minimum allowed value.
	 *
	 * @var int
	 */
	public int $min = 0;

	/**
	 * Maximum allowed value.
	 *
	 * @var int
	 */
	public int $max = 100;

	/**
	 * Increment step size.
	 *
	 * @var int
	 */
	public int $step = 1;

	/**
	 * Enqueue control-specific assets.
	 *
	 * Inlines a small stylesheet so the range and number inputs sit side-by-side
	 * without requiring an additional CSS file.
	 */
	public function enqueue(): void {
		wp_add_inline_style(
			'customize-controls',
			'
            .customize-control-range .range-control-wrapper {
                display: flex;
                align-items: center;
                gap: 8px;
            }
            .customize-control-range input[type="range"] {
                flex: 1;
            }
            .customize-control-range input[type="number"] {
                width: 60px;
                text-align: center;
            }
            '
		);
	}

	/**
	 * Render the control HTML.
	 *
	 * The number input mirrors the range value for keyboard-accessible editing.
	 */
	public function render_content(): void {
		$input_id = 'customize-control-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) );
		?>
		<?php if ( ! empty( $this->label ) ) : ?>
			<label for="<?php echo esc_attr( $input_id ); ?>">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			</label>
		<?php endif; ?>

		<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
		<?php endif; ?>

		<div class="range-control-wrapper">
			<input
				type="range"
				id="<?php echo esc_attr( $input_id ); ?>"
				min="<?php echo esc_attr( (string) $this->min ); ?>"
				max="<?php echo esc_attr( (string) $this->max ); ?>"
				step="<?php echo esc_attr( (string) $this->step ); ?>"
				value="<?php echo esc_attr( (string) $this->value() ); ?>"
				<?php $this->link(); ?>
			/>
			<input
				type="number"
				min="<?php echo esc_attr( (string) $this->min ); ?>"
				max="<?php echo esc_attr( (string) $this->max ); ?>"
				step="<?php echo esc_attr( (string) $this->step ); ?>"
				value="<?php echo esc_attr( (string) $this->value() ); ?>"
				aria-label="<?php echo esc_attr( $this->label ); ?>"
				oninput="this.previousElementSibling.value = this.value; this.previousElementSibling.dispatchEvent(new Event('input', {bubbles:true}));"
			/>
		</div>
		<?php
	}
}
