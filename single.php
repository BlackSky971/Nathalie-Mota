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
            <img src="<?php echo esc_url(wp_get_attachment_url(34)); ?>" alt="Contact"/>
            <!-- Formulaire -->
            <?php echo do_shortcode('[contact-form-7 id="b8b1027" title="Formulaire de contact 2"]'); ?>
        </div>
    </div>

</div>


<?php get_footer(); ?>