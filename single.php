<?php

get_header();
the_post();
?>
    <div class="body">
        <div class="conteneur">
            <div class="information-photo">
                <h2 class="titre-photo"> <?php echo the_title(); ?></h2>
                <ul>
                    <li>
                        <p class="info">RÉFÉRENCE : <span id="reference"> <?php echo get_field('reference'); ?></span>
                        </p>
                    </li>
                    <li>
                        <p class="info">CATÉGORIE : <?php echo get_the_terms(get_the_ID(), 'categorie')[0]->name; ?></p>
                    </li>
                    <li>
                        <p class="info">FORMAT : <?php echo get_the_terms(get_the_ID(), 'format')[0]->name; ?></p>
                    </li>
                    <li>
                        <p class="info">TYPE : <?php echo get_field('type'); ?></p>
                    </li>

            </div>
            <div class='affichage-photo'>
                <?php the_post_thumbnail("medium_large"); ?>
            </div>
            </ul>
        </div>
        <div class="contact_block conteneur">
            <div class="texte-contact">
                <p>Cette photo vous intéresse ?</p>
                <button id="myBtn-photo" class="contact_button"
                        data-photo-ref="<?php echo esc_attr(get_field('reference')); ?>">
                        Contact
                </button>
            </div>
        <div class="nav_photo">
            <?php
            $next_post = get_next_post();
            $previous_post = get_previous_post();

            if ($next_post || $previous_post) {
                echo '<div class="miniature-nav-container">';
        
                if ($previous_post) {
                    echo '<div class="miniatureprev">';
                    echo get_the_post_thumbnail($previous_post->ID, [100, 100]);
                    echo '<div class="custom_arrow">&#10229;</div>';
                    echo '</div>';
                }
        
                if ($next_post) {
                    echo '<div class="miniaturenext">';
                    echo get_the_post_thumbnail($next_post->ID, [100, 100]);
                    echo '<div class="custom_arrow">&#10230;</div>';
                    echo '</div>';
                }
        
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <!-- Modale - Single Photo -->
    <div id="myModal-photo" class="modal-photo">
        <!-- Contenu Modale -->
        <div class="modal-content-photo">
            <span class="close-photo">×</span>
            <p class="photo-reference">Référence : <span id="modal-photo-ref"></span></p>
            <!-- Formulaire -->
            <?php echo do_shortcode('[contact-form-7 id="b8b1027" title="Formulaire de contact 2"]'); ?>
        </div>
    </div>
  <!-- Section Photos Apparentées -->
<div class="related-images">
    <h3>VOUS AIMEREZ AUSSI</h3>
    <div class="image-container">
        <?php
        // Récupère les slugs de la catégorie du post actuel
        $current_categories = get_the_terms(get_the_ID(), 'categorie');
        $current_category_slugs = array();

        if ($current_categories && !is_wp_error($current_categories)) {
            foreach ($current_categories as $cat) {
                $current_category_slugs[] = $cat->slug;
            }
        }

        // Requête pour 2 photos aléatoires de la même catégorie
        $args_related_photos = array(
            'post_type' => 'photos',
            'posts_per_page' => 2,
            'orderby' => 'rand',
            'post__not_in' => array(get_the_ID()), // Exclut le post actuel
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'slug',
                    'terms' => $current_category_slugs,
                ),
            ),
        );

        $related_photos_query = new WP_Query($args_related_photos);

        $i = 0;
        while ($related_photos_query->have_posts()) :
            $related_photos_query->the_post();

            $class = ($i === 1) ? 'left' : 'right';
        ?>
            <div class="related-image <?php echo $class; ?>">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('custom-square'); ?>
                </a>
                <!-- Overlay sur chaque image -->
                <div class="thumbnail-overlay-single">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_eye.png" alt="Icône de l'œil">
                    <i class="fas fa-expand-arrows-alt fullscreen-icon"></i>
                </div>
            </div>
        <?php
            $i++;
        endwhile;
        wp_reset_postdata();
        ?>
    </div>

    <!-- Bouton global, en dehors de la boucle -->
    <div class="home-button">
        <a href="<?php echo home_url(); ?>" class="button">Toutes les photos</a>
    </div>
</div>

<?php get_footer(); ?>
