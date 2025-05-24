<?php get_template_part('templates_part/contact-modal'); ?>
<footer class="site-footer">
    <hr>
    <div class="footer-content">
        <a href="#">MENTIONS LÉGALES</a>
        <a href="#">VIE PRIVÉE</a>
        <span>TOUS DROITS RÉSERVÉS</span>
    </div>
</footer>

<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
<div class="modal-container">
    <span class="btn-close">✕</span>
    <div class="modal-content">
        <div class="left-arrow"></div>
        <img class="middle-image" src="" alt="">
        <div class="right-arrow"></div>
        <div class="photo-info">
            <p id="modal-reference"></p>
            <p id="modal-category"></p>
        </div>
    </div>
</div>
</body>
</html>
