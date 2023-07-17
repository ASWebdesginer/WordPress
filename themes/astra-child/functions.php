<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if (!function_exists('chld_thm_cfg_locale_css')) :
  function chld_thm_cfg_locale_css($uri)
  {
    if (empty($uri) && is_rtl() && file_exists(get_template_directory() . '/rtl.css'))
      $uri = get_template_directory_uri() . '/rtl.css';
    return $uri;
  }
endif;
add_filter('locale_stylesheet_uri', 'chld_thm_cfg_locale_css');

if (!function_exists('child_theme_configurator_css')) :
  function child_theme_configurator_css()
  {
    wp_enqueue_style('chld_thm_cfg_child', trailingslashit(get_stylesheet_directory_uri()) . 'style.css', array('astra-theme-css'));
  }
endif;
add_action('wp_enqueue_scripts', 'child_theme_configurator_css', 10);

// END ENQUEUE PARENT ACTION
// ikonic assements
require_once get_stylesheet_directory() . '/ikonictask.php';



add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

function enqueue_custom_scripts()
{
  // Enqueue your custom script
  wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/ajax.js', array('jquery'), '1.0', true);

  // Pass the AJAX endpoint URL to your custom script
  wp_localize_script('custom-script', 'custom_ajax', array(
    'ajaxurl' => admin_url('admin-ajax.php')
  ));
}

// register the AJAX action hooks for both logged-in and non-logged-in users.

add_action('wp_ajax_nopriv_get_architecture_projects', 'get_architecture_projects');
add_action('wp_ajax_get_architecture_projects', 'get_architecture_projects');

function get_architecture_projects()
{
  // Check if the user is logged in
  $is_logged_in = is_user_logged_in();

  // Number of projects to retrieve based on user login status
  $num_projects = $is_logged_in ? 6 : 3;

  // Query to fetch the last published architecture projects
  $args = array(
    'post_type' => 'projectS',
    'post_status' => 'publish',
    'tax_query' => array(
      array(
        'taxonomy' => 'project_type',
        'field' => 'slug',
        'terms' => 'architecture'
      )
    ),
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => $num_projects
  );

  $projects = new WP_Query($args);

  // Prepare the response data
  $response = array(
    'success' => true,
    'data' => array()
  );

  while ($projects->have_posts()) {
    $projects->the_post();

    // Prepare the project object
    $project_object = array(
      'id' => get_the_ID(),
      'title' => get_the_title(),
      'link' => get_permalink()
    );

    // Add the project object to the response data
    $response['data'][] = $project_object;
  }

  wp_reset_postdata();

  // Return the JSON response
  wp_send_json($response);
}
