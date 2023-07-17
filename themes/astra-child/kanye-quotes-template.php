<?php
/*
 * Template Name: Kanye West Quotes Template
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        // Make a GET request to the Kanye West Quotes API
        $quotes = array();

        for ($i = 0; $i < 5; $i++) {
            $response = wp_remote_get('https://api.kanye.rest/');

            if (is_wp_error($response)) {
                // Request failed, handle the error
                echo 'Error: Failed to retrieve Kanye quotes. Please try again later.';
                break;
            } else {
                // Retrieve the response body
                $body = wp_remote_retrieve_body($response);

                // Parse the JSON response
                $data = json_decode($body, true);

                if (isset($data['quote'])) {
                    // Add the quote to the array
                    $quotes[] = $data['quote'];
                } else {
                    // Quotes not found in the response
                    echo 'Error: Unable to retrieve Kanye quotes.';
                    break;
                }
            }
        }

        // Output the quotes
        if (!empty($quotes)) {
            echo '<ul>';
            foreach ($quotes as $quote) {
                echo '<li>' . esc_html($quote) . '</li>';
            }
            echo '</ul>';
        }
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
