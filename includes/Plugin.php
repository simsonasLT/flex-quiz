<?php
declare(strict_types=1);

namespace FlexQuiz;

/**
 * Main plugin orchestrator.
 */
class Plugin {

	public function init(): void {
		load_plugin_textdomain( 'flex-quiz', false, dirname( FLEX_QUIZ_BASENAME ) . '/languages' );

		( new Post_Types() )->register();
		( new Meta() )->register();
		( new Admin() )->register();
		( new Frontend() )->register();
		( new Rest() )->register();
		( new Shortcode() )->register();
		( new Block() )->register();
		( new Analytics() )->register();
		( new Settings() )->register();

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_frontend_assets' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_assets' ] );
	}

	public function enqueue_frontend_assets(): void {
		wp_register_style(
			'flex-quiz-frontend',
			FLEX_QUIZ_URL . 'assets/css/frontend.css',
			[],
			FLEX_QUIZ_VERSION
		);

		wp_register_script(
			'flex-quiz-frontend',
			FLEX_QUIZ_URL . 'assets/js/frontend.js',
			[],
			FLEX_QUIZ_VERSION,
			true
		);

		wp_localize_script( 'flex-quiz-frontend', 'FlexQuizData', [
			'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
			'restUrl'   => rest_url( 'flex-quiz/v1/' ),
			'nonce'     => wp_create_nonce( 'wp_rest' ),
			'i18n'      => [
				'next'       => __( 'Next', 'flex-quiz' ),
				'prev'       => __( 'Previous', 'flex-quiz' ),
				'submit'     => __( 'Submit Quiz', 'flex-quiz' ),
				'correct'    => __( 'Correct!', 'flex-quiz' ),
				'incorrect'  => __( 'Incorrect', 'flex-quiz' ),
				'yourScore'  => __( 'Your Score', 'flex-quiz' ),
				'tryAgain'   => __( 'Try Again', 'flex-quiz' ),
			],
		] );
	}

	public function enqueue_admin_assets( string $hook ): void {
		global $post_type;

		if ( ( 'post.php' === $hook || 'post-new.php' === $hook ) && 'flex_quiz' === $post_type ) {
			wp_enqueue_style(
				'flex-quiz-admin',
				FLEX_QUIZ_URL . 'assets/css/admin.css',
				[ 'wp-components' ],
				FLEX_QUIZ_VERSION
			);

			wp_enqueue_script(
				'flex-quiz-admin',
				FLEX_QUIZ_URL . 'assets/js/admin.js',
				[ 'jquery', 'wp-api-fetch', 'wp-components', 'wp-element', 'wp-i18n' ],
				FLEX_QUIZ_VERSION,
				true
			);

			wp_localize_script( 'flex-quiz-admin', 'FlexQuizAdmin', [
				'restUrl' => rest_url( 'flex-quiz/v1/' ),
				'nonce'   => wp_create_nonce( 'wp_rest' ),
				'postId'  => get_the_ID(),
			] );
		}

		if ( 'toplevel_page_flex-quiz-settings' === $hook ) {
			wp_enqueue_style( 'flex-quiz-admin', FLEX_QUIZ_URL . 'assets/css/admin.css', [], FLEX_QUIZ_VERSION );
		}
	}
}
