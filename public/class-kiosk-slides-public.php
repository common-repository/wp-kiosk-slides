<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       www.enformio.at
 * @since      1.0.0
 *
 * @package    Enformio_Kiosk_Slides
 * @subpackage Enformio_Kiosk_Slides/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Enformio_Kiosk_Slides
 * @subpackage Enformio_Kiosk_Slides/public
 * @author     ENFORMIO <office@enformio.at>
 */
class Enformio_Kiosk_Slides_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Enformio_Kiosk_Slides_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Enformio_Kiosk_Slides_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/kiosk-slides-public.css', array(), $this->version, 'all' );

		wp_register_style('prefix_bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
		wp_enqueue_style('prefix_bootstrap');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Enformio_Kiosk_Slides_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Enformio_Kiosk_Slides_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/kiosk-slides-public.js', array( 'jquery' ), $this->version, false );

		wp_register_script('prefix_bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
		wp_enqueue_script('prefix_bootstrap');
	}

	public function replace_Enformio_Kiosk_Slides_placeholder($text) {

		$placeholder = '[kiosk_slides]';
		if (strpos($text, $placeholder) !== false) {
			$content = $this->getKioskSlidesHtml();
			$text = str_replace($placeholder, $content, $text);
		}

		return $text;
	}


	public function getKioskSlidesHtml() {
		$activeText = ' active';

		$options = get_option($this->plugin_name);

		$default_interval = $options['default_interval'];
		if ($default_interval == "")
			$default_interval = 3000;
		$post_category_slug = $options['post_category_slug'];

		$result = '<div class="carousel slide" data-ride="carousel" data-interval="'. $default_interval .'" data-pause="false">';
		$result .= '<div class="carousel-inner">';

		$args = array(
        'post_type' => 'post',
				'category_name' => $post_category_slug
    	);

    	$post_query = new WP_Query($args);
		if($post_query->have_posts() ) {
			while($post_query->have_posts() ) {
	    		$post_query->the_post();
					$result .= '<div class="item ' . $activeText . '">';
					$activeText = '';
	    		$result .= '<h2>'. get_the_title() . '</h2>';
					$result .= get_the_post_thumbnail();
					$result .= get_the_content();
					$result .= '</div>';
  			}
		}

		$result .= '</div>';
		$result .= '</div>';

		return $result;
	}
}
