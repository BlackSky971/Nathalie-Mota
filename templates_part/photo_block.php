<!-- Section | Miniatures Personnalisées -->
<div class="custom-post-thumbnails">
    <input type="hidden" name="page" value="1">
    <div class="thumbnail-container-accueil">
        <?php
        // Arguments | Requête pour les publications personnalisées
        $args_custom_posts = array(
            'post_type' => 'photos',          // Type de publication personnalisée (photos) 
            'posts_per_page' => 8,          // Nombre de publications à afficher par page
            'orderby' => 'date',             // Tri des publications par date
            'order' => 'DESC',               // Ordre de tri descendant - (de la plus récente à la plus ancienne).
        );        

        $custom_posts_query = new WP_Query($args_custom_posts);

        // Boucle | Parcourir les publications personnalisées
        while ($custom_posts_query->have_posts()) :
            $custom_posts_query->the_post();
        ?>
        <div class="custom-post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="thumbnail-wrapper">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                            <!-- Section | Overlay Catalogue -->
                            <div class="thumbnail-overlay">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_eye.png" alt = "Icône de l'oeil">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_fullscreen.png" alt = "Icône plein écran">
                                <?php
                                // Récupère la référence et la catégorie de l'image associée.
                                $related_reference_photos = get_field('reference');   // Récupère la référence de la photo
                                $related_categories = get_the_terms(get_the_ID(), 'categorie');   // Récupère les catégories de la photo
                                $related_category_names = array();

                                if ($related_categories) {
                                    foreach ($related_categories as $category) {
                                        $related_category_names[] = esc_html($category->name);
                                    }
                                }
                                ?>
                                <!-- Overlay | Récupère la Référence et la Catégorie de l'image associée au survol-->
                                <div class="photo-info">
                                    <div class="photo-info-left">
                                        <p><?php echo $related_reference_photos; ?></p>
                                    </div>
                                    <div class="photo-info-right">
                                        <p><?php echo implode(', ', $related_category_names); ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
            </a>
        </div>
        <?php endwhile; ?>

        <?php wp_reset_postdata(); // Rétablir les données de publication d'origine ?>
    </div>
    <!-- Ajouter un lien pour afficher toutes les publications personnalisées -->
    <div class="view-all-button">
        <button id="load-more-posts">Charger plus</button>
    </div>
</div>
