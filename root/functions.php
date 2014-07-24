<?php
/**
 * {%= title %} functions and definitions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * @package {%= title %}
 * @since 0.1.0
 */

// Useful global constants
define( '{%= prefix_caps %}_VERSION', '0.1.0' );


{%= prefix_caps %}_Setup::get_instance();
class {%= prefix_caps %}_Setup {

	/**
	 * @var
	 */
	protected static $_instance;

	/**
	 * Only make one instance of the {%= prefix_caps %}_Setup
	 *
	 * @return {%= prefix_caps %}_Setup
	 */
	public static function get_instance() {
		if ( ! self::$_instance instanceof {%= prefix_caps %}_Setup ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Add Hooks and Actions
	 */
	protected function __construct() {
		$this->add_includes();
		$this->add_filters();
		$this->add_actions();
	}

	protected function add_includes() {
		/**
		 * Implement the Custom Header feature.
		 */
		require get_template_directory() . '/inc/custom-header.php';

		/**
		 * Custom template tags for this theme.
		 */
		require get_template_directory() . '/inc/template-tags.php';

		/**
		 * Custom functions that act independently of the theme templates.
		 */
		require get_template_directory() . '/inc/extras.php';

		/**
		 * Customizer additions.
		 */
		require get_template_directory() . '/inc/customizer.php';

		/**
		 * Load Jetpack compatibility file.
		 */
		require get_template_directory() . '/inc/jetpack.php';

		/**
		 * Include custom Foundation functionality
		 */
		require get_template_directory() . '/inc/classes.php';
	}

		/**
		 * Wire up filters
		 */
	protected function add_filters() {
		add_filter( 'wp_title', array( $this, 'wp_title_for_home' ) );
	}

	/**
	 * Custom page header for home page
	 *
	 * @param $title
	 *
	 * @return string
	 */
	public function wp_title_for_home( $title ) {
		if( empty( $title ) && ( is_home() || is_front_page() ) ) {
			return get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
		}
		return $title;
	}

	/**
	 * Wire up actions
	 */
	protected function add_actions() {
		add_action( 'after_setup_theme',  array( $this, 'setup'              ) );
		add_action( 'widgets_init',       array( $this, 'add_sidebars'       ) );
		add_action( 'widgets_init',       array( $this, 'unregister_widgets' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue'            ) );
	}

	/**
	 * Theme setup
	 */
	public function setup() {
		add_editor_style();

		$this->add_image_sizes();

		$this->add_menus();

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on {%= prefix }, use a find and replace
		 * to change '{%= prefix }' to the name of your theme in all the template files
		 */
		load_theme_textdomain( '{%= prefix }', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails on posts and pages
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Setup the WordPress core custom background feature.
		 */
		add_theme_support( 'custom-background', apply_filters( '{%= prefix }_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
	}

	/**
	 * Register theme sidebars
	 */
	public function add_sidebars() {

		$defaults = array(
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		);

		$sidebars = array(
			array(
				'id'          => 'sidebar',
				'name'        => 'Default Sidebar',
				'description' => 'Default sidebar display',
			),
			array(
				'id'          => 'home-sidebar',
				'name'        => 'Homepage Sidebar',
				'description' => 'Sidebar display for the homepage',
			),
			array(
				'id'          => 'lp-sidebar',
				'name'        => 'Landing Page Sidebar',
				'description' => 'Sidebar display for landing page (formerly Homepage 2) template',
			),
			array(
				'id'          => 'pb-sidebar',
				'name'        => 'Playbooks Sidebar',
				'description' => 'Sidebar display for Playbooks',
			),
			array(
				'id'          => 'kids-sidebar',
				'name'        => 'Kids Sidebar',
				'description' => 'Sidebar display for Kids Playbooks and other Kids pages',
			),
			array(
				'id'          => 'blog-sidebar',
				'name'        => 'Blog Sidebar',
				'description' => 'Sidebar display for blog and blog posts',
			),
			array(
				'id'          => 'sop-sidebar',
				'name'        => 'Science of Play Sidebar',
				'description' => 'Sidebar display for Science of Play and other pages',
			),
			array(
				'id'          => 'al-sidebar',
				'name'        => 'Alternative Learners Sidebar',
				'description' => 'Sidebar display for Alternative Learner pages',
			),
			array(
				'id'          => 'forum-sidebar',
				'name'        => 'Forum Sidebar',
				'description' => 'Sidebar display for the forums',
			),
			array(
				'id'          => 'membership-sidebar',
				'name'        => 'Membership Sidebar',
				'description' => 'Sidebar display for Member Info, Sign-Up, Checkout & Login pages',
			),
			array(
				'id'          => 'assessment-sidebar',
				'name'        => 'Assessment Sidebar',
				'description' => 'Sidebar display for Thinking Skills Mini-Assessment & All Assessment Results pages',
			),

		);

		foreach( $sidebars as $sidebar ) {
			register_sidebar( array_merge( $sidebar, $defaults ) );
		}

	}

	/**
	 * Unregister widgets
	 */
	public function unregister_widgets() {
		unregister_widget( 'WP_Widget_Pages'        );
		unregister_widget( 'WP_Widget_Calendar'     );
		unregister_widget( 'WP_Widget_Links'        );
		unregister_widget( 'WP_Widget_Meta'         );
		unregister_widget( 'WP_Widget_Recent_Posts' );
	}

	/**
	 * Enqueue styles and scripts
	 */
	public function enqueue() {
		$this->enqueue_scripts();
		$this->enqueue_styles();
	}

	/**
	 * Enqueue Styles
	 */
	protected function enqueue_styles() {
		$postfix = ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) ? '' : '.min';

		wp_enqueue_style( '{%= prefix }', get_template_directory_uri() . "/assets/css/{%= js_safe_name %}_theme{$postfix}.css", array(), {%= prefix_caps %}_VERSION );
	}

	/**
	 * Enqueue scripts
	 */
	protected function enqueue_scripts() {
		$postfix = ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) ? '' : '.min';

		/**
		 * Libraries and performance scripts
		 */
		wp_enqueue_script( 'navigation',          get_template_directory_uri() . '/assets/js/lib/navigation.js',          array(),           '20120206', true );
		wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/assets/js/lib/skip-link-focus-fix.js', array(),           '20130115', true );
		wp_enqueue_script( 'zepto',               get_template_directory_uri() . '/assets/js/lib/zepto.js',               array(),           '01',       true );
		wp_enqueue_script( 'foundation',          get_template_directory_uri() . '/assets/js/lib/foundation.min.js',      array( 'jquery' ), '01',       true );

		wp_enqueue_script('myapp', get_template_directory_uri(). '/js/{%= prefix }.js', array(), '01', true);
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if ( is_singular() && wp_attachment_is_image() ) {
			wp_enqueue_script( '{%= prefix }-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
		}

		wp_enqueue_script( '{%= prefix }', get_template_directory_uri() . "/assets/js/{%= js_safe_name %}_theme{$postfix}.js", array( 'jquery', 'foundation' ), {%= prefix_caps %}_VERSION, true );
	}

	/**
	 * Add custom image sizes
	 */
	protected function add_image_sizes() {}

	/**
	 * Register theme menues
	 */
	protected function add_menus() {
		register_nav_menus( array(
			'menu'   => 'Top Menu',
			'social' => 'Social Menu',
			'footer' => 'Footer Menu',
		) );
	}

}