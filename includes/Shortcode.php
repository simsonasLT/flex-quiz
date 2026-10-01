<?php
declare(strict_types=1);

namespace FlexQuiz;

class Shortcode {

	public function register(): void {
		add_shortcode( 'flexquiz', [ $this, 'render' ] );
	}

	public function render( array $atts ): string {
		$atts = shortcode_atts( [
			'id' => 0,
		], $atts, 'flexquiz' );

		$quiz_id = absint( $atts['id'] );
		if ( ! $quiz_id || 'flex_quiz' !== get_post_type( $quiz_id ) ) {
			return '<p>' . esc_html__( 'Invalid quiz ID.', 'flex-quiz' ) . '</p>';
		}

		$frontend = new Frontend();
		return $frontend->render_quiz( $quiz_id );
	}
}
