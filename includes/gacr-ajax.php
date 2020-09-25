<?php
// /wp-admin/admin-ajax.php?action=gga_posts_by_taxonomy
//&post_type=post
//&taxonomy=post_tag
//&term=android
//&cat=5
//&offset=4

add_action('wp_ajax_gga_posts_by_taxonomy', 'gga_posts_by_taxonomy');
add_action('wp_ajax_nopriv_gga_posts_by_taxonomy', 'gga_posts_by_taxonomy');
function gga_posts_by_taxonomy() {
    $results = new stdClass();
    $results->posts = array();
    $post_type = isset($_REQUEST['post_type']) ? $_REQUEST['post_type'] : '';
    $taxonomy = isset($_REQUEST['taxonomy']) ? $_REQUEST['taxonomy'] : '';
    $taxonomy_term = isset($_REQUEST['term']) ? $_REQUEST['term'] : '';
    $cat = isset($_REQUEST['cat']) ? $_REQUEST['cat'] : '';
    $offset = isset($_REQUEST['offset']) ? $_REQUEST['offset'] : '';
    if (empty($post_type))
        $post_type == 'post';
    $query_args = array(
        'post_type' => $post_type,
        'posts_per_page' => 10,
        'cat' => $cat,
        'offset' =>$offset
    );
    if (!empty($taxonomy) && !empty($taxonomy_term)) {
        $query_args['tax_query'] = array(
            array(
                'taxonomy' => $taxonomy,
                'field' => 'slug',
                'terms' => $taxonomy_term,
            )
        );
    }
    if (!empty($category)) {
        array_push($query_args, "cat", $category);
    }
    global $post;
    $query = new WP_Query($query_args);
    while ($query->have_posts()) {
        $query->the_post();
        $results->posts[] = array(
            'id' => $post->ID,
            'permalink' => get_permalink( $post->ID ),
            'post_title' => get_the_title( $post->ID ),
            'post_excerpt' => str_replace( [ '&nbsp;' ], ' ', get_the_excerpt( $post->ID ) ),
            'post_name' => $post->post_name,
            'post_date' => get_the_date(),
            'post_thumbnail' => get_the_post_thumbnail_url(),
        );
    }
    wp_reset_query();
    header('Content-Type: application/json');
    echo json_encode($results);
    die();
}
?>