<?php
function enqueue_normalizer_styles()
{
    wp_enqueue_style('normalize', get_stylesheet_directory_uri() . '/assets/css/normalize.css', array(), false, 'all');
    wp_enqueue_style('bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', array(), false, 'all');
    wp_enqueue_style('main-stylesheet', get_stylesheet_uri(), array('normalize', 'bootstrap'), "1.0", 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_normalizer_styles');

function enqueue_custom_scripts()
{
    wp_enqueue_script('main-js', get_stylesheet_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

function custom_theme_setup()
{
    // Adds <title> tag support
    add_theme_support('title-tag');

    // Add custom-logo support
    add_theme_support('custom-logo');

    // Register Display Locations
    register_nav_menus(array(
        'header' => 'Display this menu in header',
        'footer' => 'Display this menu in footer',
    ));
}
add_action('after_setup_theme', 'custom_theme_setup');

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function register_custom_sidebars()
{
    register_sidebar(array(
        'name' => esc_html__('Footer Section One'),
        'id' => 'footer-section-one',
        'description' => esc_html__('Widgets added here would appear inside the first section of the footer'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '',
        'after_title' => '',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Section Two'),
        'id' => 'footer-section-two',
        'description' => esc_html__('Widgets added here would appear inside the second section of the footer'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
    ));
}
add_action('widgets_init', 'register_custom_sidebars');

function get_ip_address()
{
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (array_map('trim', explode(',', $_SERVER[$key])) as $ip) {
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    return $ip;
                }
                else return 'Not detected';
            }
        }
        else return 'N/A';
    }
}
function save_user_ip_address($user_login, $user)
{
    $ip_addr = get_ip_address();
    add_user_meta($user->ID, 'ip_address', $ip_addr, false);
}
add_action( 'wp_login', 'save_user_ip_address', 10, 2);

function var_sc()
{
    global $test_var;
    $test_var = get_ip_address();
    $output = "<span>" . $test_var . "</span>";
    return $output;
}
add_shortcode('debugcode', 'var_sc');

function custom_fee() {
    if (is_admin() && !defined('DOING_AJAX')) {
		return;
	}
	WC()->cart->add_fee(__('Insurance Fee', 'txtdomain'), 10);
}
add_action('woocommerce_cart_calculate_fees', 'custom_fee');
