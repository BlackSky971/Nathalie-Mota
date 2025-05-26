// LIGHTBOX - NAVIGATION PHOTOS 
    // Ajouter une division modale lorsque l'on clique sur une image dans .right-container
    jQuery(document).ready(function($) {

        $('.fullscreen-icon').click(function(e) {
            e.preventDefault();
    
            // Ajoute la classe 'opened' à la boîte modale
            $('.modal-container').addClass('opened');
    
            // Obtient l'URL de l'image cliquée
            const imageSrc = $(this).closest('.thumbnail-wrapper').find('img').attr('src');
            console.log("Valeur de imageSrc :", imageSrc);
    
            // Clone les flèches précédentes et suivantes
            const prevArrow = $('#prev-arrow-link').clone();
            const nextArrow = $('#next-arrow-link').clone();
    
            // Obtient les valeurs de référence et de catégorie à partir de leurs éléments correspondants
            const reference = $('#ph-reference').text();
            const category = $('#ph-category').text();
    
            // Met à jour les éléments de la boîte modale avec les valeurs obtenues
            $('#modal-reference').html(reference);
            $('#modal-category').html(category);
            $('.middle-image').attr('src', imageSrc);
            $('.left-arrow').html(prevArrow);
            $('.right-arrow').html(nextArrow);
    
            // Obtient les liens des flèches précédentes et suivantes
            const refLeft = $('.left-arrow > a').attr('href');
            const refRight = $('.right-arrow > a').attr('href');
    
            // Modifie les liens des flèches pour inclure "?modal=1"
            $('.left-arrow > a').attr('href', refLeft + '?modal=1');
            $('.right-arrow > a').attr('href', refRight + '?modal=1');
    
            // Ajoute "Précédente" à la flèche de gauche si le span n'existe pas encore
            if (!$('.left-arrow > a > span').length) {
                $('.left-arrow > a').append('<span>Précédente</span>');
            }
    
            // Ajoute "Suivante" à la flèche de droite si le span n'existe pas encore
            if (!$('.right-arrow > a > span').length) {
                $('.right-arrow > a').append('<span>Suivante</span>');
            }
            console.log($("#prev-arrow-link").length); // doit afficher 1
            console.log($("#next-arrow-link").length); // doit afficher 1

        });
    
        // Gestion de la fermeture de la boîte modale lorsque l'on clique sur le bouton de fermeture
        $('.btn-close').click(function(e){
            $('.modal-container').removeClass('opened');
        });
         
        // Si 'modal=1' est présent dans l'URL, simule un clic sur l'image pour ouvrir la modale automatiquement
        const queryString = window.location.search;
        const searchParams = new URLSearchParams(queryString);
        const modal = searchParams.get('modal');
    
        if (modal) {
            $('.right-container img').click();
        }
    
    });
    