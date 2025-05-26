 <!-- Trigger/Ouvrir Modale - Single Photo -->
    <button id="myBtn-photo">Contact</button>

    <!-- Modale - Single Photo -->
<div id="myModal-photo" class="modal-photo">

    <!-- Contenu Modale - Single Photo -->
    <div class="modal-content-photo">
        <span class="close-photo">X</span>
        <img src="<?php echo esc_url(wp_get_attachment_url(111)); ?>" alt="Contact" />
        <?php echo do_shortcode('[contact-form-7 id="b8b1027"=Formulaire de contact 2]'); ?>
    </div>

</div>