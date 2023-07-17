<?php

/* Write a function that will redirect the user away from the site if their IP address starts with 77.29.
 Use WordPress native hooks and APIs to handle this.*/
function redirect_users_with_ip()
{
    // Get the user's IP address
    $user_ip = $_SERVER['REMOTE_ADDR'];

    // Check if the IP address starts with "77.29"
    if (strpos($user_ip, '77.29.') === 0) {
        // Redirect the user to a different URL or external site
        wp_redirect('https://example.com');
        exit;
    }
}
add_action('template_redirect', 'redirect_users_with_ip');




// Register post type called "Projects" and a taxonomy "Project Type" for this post type.

// Register Custom Post Type
function register_projects_post_type()
{
    $labels = array(
        'name'                  => 'Projects',
        'singular_name'         => 'Project',
        'menu_name'             => 'Projects',
        'name_admin_bar'        => 'Projects',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Project',
        'new_item'              => 'New Project',
        'edit_item'             => 'Edit Project',
        'view_item'             => 'View Project',
        'all_items'             => 'All Projects',
        'search_items'          => 'Search Projects',
        'parent_item_colon'     => 'Parent Projects:',
        'not_found'             => 'No projects found.',
        'not_found_in_trash'    => 'No projects found in Trash.'
    );

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'projects'),
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => null,
        'supports'              => array('title', 'editor', 'thumbnail')
    );

    register_post_type('projects', $args);
}
add_action('init', 'register_projects_post_type');

// Register Custom Taxonomy
function register_project_type_taxonomy()
{
    $labels = array(
        'name'                       => 'Project Types',
        'singular_name'              => 'Project Type',
        'menu_name'                  => 'Project Types',
        'all_items'                  => 'All Project Types',
        'parent_item'                => 'Parent Project Type',
        'parent_item_colon'          => 'Parent Project Type:',
        'new_item_name'              => 'New Project Type Name',
        'add_new_item'               => 'Add New Project Type',
        'edit_item'                  => 'Edit Project Type',
        'update_item'                => 'Update Project Type',
        'view_item'                  => 'View Project Type',
        'separate_items_with_commas' => 'Separate project types with commas',
        'add_or_remove_items'        => 'Add or remove project types',
        'choose_from_most_used'      => 'Choose from the most used project types',
        'popular_items'              => 'Popular Project Types',
        'search_items'               => 'Search Project Types',
        'not_found'                  => 'No project types found.',
        'no_terms'                   => 'No project types',
        'items_list'                 => 'Project types list',
        'items_list_navigation'      => 'Project types list navigation',
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'rewrite'                    => array('slug' => 'project-type'),
    );

    register_taxonomy('project_type', array('projects'), $args);
}
add_action('init', 'register_project_type_taxonomy');


// coffee task
/* function to fetch the link to the coffee */
function hs_give_me_coffee()
{
    $api_url = 'https://coffee.alexflipnote.dev/random.json';
    $response = wp_remote_get($api_url);

    if (is_wp_error($response)) {
        // Error handling if the API request fails
        return 'Sorry, something went wrong while fetching the coffee. Please try again later.';
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);

    if (!$data || empty($data->file)) {
        // Error handling if the API response is invalid or missing data
        return 'Sorry, the coffee link could not be found. Please try again later.';
    }

    // Return the direct link to the coffee
    return $data->file;
}

/* to send link to admin email address */
function send_coffee_link_to_admin()
{
    // Get the admin email
    $admin_email = get_option('admin_email');

    // Get the coffee link
    $coffee_link = hs_give_me_coffee();

    // Email subject
    $subject = 'Enjoy a Cup of Coffee!';

    // Email message
    $message = 'Here is your direct link to a cup of coffee: ' . $coffee_link;

    // Send email to admin
    wp_mail($admin_email, $subject, $message);
}
add_action('admin_init', 'send_coffee_link_to_admin');
