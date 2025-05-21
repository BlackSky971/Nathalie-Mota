<?php
function nathalie_mota_setup() {
    // Support du titre dynamique
    add_theme_support('title-tag');
    
    // Enregistrement du menu
    register_nav_menus(array(
        'main-menu' => __('Menu Principal', 'nathalie-mota')
    ));
}
add_action('after_setup_theme', 'nathalie_mota_setup');

// Enqueue styles et scripts
function nathalie_mota_assets() {
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap', false);

    // CSS principal
    wp_enqueue_style('style-css', get_stylesheet_uri());

    // JS principal
    wp_enqueue_script('script-js', get_template_directory_uri() . '/js/script.js', array('jquery'), null, true);

    // Lightbox
    wp_enqueue_script('lightbox-single-photo', get_template_directory_uri() . '/js/lightbox-single-photo.js', array('jquery'), '1.0', true);
   
   


add_action('wp_enqueue_scripts', 'enqueue_custom_styles');
}
add_action('wp_enqueue_scripts', 'nathalie_mota_assets');
wp_enqueue_script('script-js', get_template_directory_uri() . '/js/script.js', array('jquery'), time(), true);
wp_enqueue_script('script-js', get_template_directory_uri() . '/js/script.js', array('jquery'), filemtime(get_template_directory() . '/js/script.js'), true);
add_theme_support('post-thumbnails');
add_post_type_support( 'photo', 'thumbnail' );

// Ajout du fichier JavaScript (Pagination infinie - Bloc Photo)
function enqueue_infinite_pagination_js() {
    wp_enqueue_script('infinite-pagination', get_template_directory_uri() . '/js/infinite-pagination.js', array('jquery'), '', true);
    wp_localize_script('infinite-pagination', 'wp_data', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_infinite_pagination_js');




add_action('wp_ajax_load_more_posts', 'load_more_posts'); // Associe la fonction 'load_more_posts' à l'action AJAX 'wp_ajax_load_more_posts'
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts'); // Associe la fonction 'load_more_posts' à l'action AJAX 'wp_ajax_nopriv_load_more_posts'

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');
// Pour tracer si wp_body_open est appelé
add_action('wp_body_open', function() {
    error_log('🛠 wp_body_open action triggered.');
});


function load_more_posts() {
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $category = sanitize_text_field($_GET['category']);
    $format = sanitize_text_field($_GET['format']);
    $date_sort = sanitize_text_field($_GET['dateSort']);

    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => 8,
        'paged' => $page,
    );

    // Tri par date
    if ($date_sort === 'ASC' || $date_sort === 'DESC') {
        $args['orderby'] = 'date';
        $args['order'] = $date_sort;
    }

    // Filtre catégorie (taxo personnalisée)
    if ($category && $category !== 'ALL') {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field'    => 'slug',
            'terms'    => $category,
        );
    }

    // Filtre format
    if ($format && $format !== 'ALL') {
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field'    => 'slug',
            'terms'    => $format,
        );
    }

    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            ?>
            <div class="custom-post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="thumbnail-wrapper">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail(); ?>
                                <div class="thumbnail-overlay">
                                    <div class="eye-icon"></div>
                                    <i class="fas fa-expand-arrows-alt fullscreen-icon"></i>
                                    <?php
                                    $reference = get_field('reference_photos');
                                    $categories = get_the_terms(get_the_ID(), 'categorie');
                                    $cat_names = [];

                                    if ($categories) {
                                        foreach ($categories as $cat) {
                                            $cat_names[] = esc_html($cat->name);
                                        }
                                    }
                                    ?>
                                    <div class="photo-info">
                                        <div class="photo-info-left">
                                            <p><?php echo esc_html($reference); ?></p>
                                        </div>
                                        <div class="photo-info-right">
                                            <p><?php echo implode(', ', $cat_names); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                </a>
            </div>
            <?php
        endwhile;
    endif;

    wp_reset_postdata();

    $html = ob_get_clean();
    echo $html;
    wp_die(); // toujours à la fin d’un handler AJAX
   
    //Ajout Library Ajax
    function ajouter_font_awesome() {
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
    }
    add_action('wp_enqueue_scripts', 'ajouter_font_awesome');
    
}
