<?php
declare(strict_types=1);

namespace FlexQuiz;

class Block {

	public function register(): void {
		add_action( 'init', [ $this, 'register_block' ] );
	}

	public function register_block(): void {
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		register_block_type( 'flex-quiz/quiz', [
			'api_version'     => 3,
			'title'           => __( 'Flex Quiz', 'flex-quiz' ),
			'description'     => __( 'Embed a Flex Quiz', 'flex-quiz' ),
			'category'        => 'widgets',
			'icon'            => 'forms',
			'keywords'        => [ 'quiz', 'test', 'assessment' ],
			'supports'        => [
				'html'   => false,
				'align'  => [ 'wide', 'full' ],
			],
			'attributes'      => [
				'quizId' => [
					'type'    => 'number',
					'default' => 0,
				],
			],
			'render_callback' => [ $this, 'render' ],
		] );
	}

	public function render( array $attributes ): string {
		$quiz_id = absint( $attributes['quizId'] ?? 0 );
		if ( ! $quiz_id ) {
			return '<p>' . esc_html__( 'Please select a quiz in the block settings.', 'flex-quiz' ) . '</p>';
		}

		$frontend = new Frontend();
		return $frontend->render_quiz( $quiz_id );
	}
}
