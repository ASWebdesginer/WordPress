<?php
/*
Template Name: Projects Archive
*/

get_header();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type'      => 'projects',
    'posts_per_page' => 6,
    'paged'          => $paged,
);

$projects_query = new WP_Query($args);
?>
<div class="projectarchive">
    <div class="showprojects_container">
        <?php
        if ($projects_query->have_posts()) :
            while ($projects_query->have_posts()) :
                $projects_query->the_post();

                // Display project content
        ?>
                <div class="project-item">

                    <?php
                    // Check if project has a featured image
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('medium');
                    }
                    ?>

                    <h2><?php the_title(); ?></h2>
                    <?php
                    // Check if project has an excerpt
                    if (has_excerpt()) {
                        the_excerpt();
                    }
                    ?>

                    <?php
                    // Check if project has project type assigned
                    $project_types = get_the_terms(get_the_ID(), 'project_type');
                    if ($project_types && !is_wp_error($project_types)) {
                        echo '<ul class="project-types">';
                        foreach ($project_types as $project_type) {
                            echo '<li>' . esc_html($project_type->name) . '</li>';
                        }
                        echo '</ul>';
                    }
                    ?>
                </div>
            <?php
            endwhile;
            ?>
    </div>
<?php
            // Display pagination
            echo '<div class="pagination">';
            previous_posts_link('« Previous');
            next_posts_link('Next »', $projects_query->max_num_pages);
            echo '</div>';

            // Reset post data
            wp_reset_postdata();

        else :
            echo 'No projects found.';
        endif;
?>
</div>
<?php
get_footer();
?>