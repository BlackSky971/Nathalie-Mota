/* 
   Nom du fichier : infinite-pagination.js
   Auteur :BlackSky971
   Date de création : Avril 2025
   Description : Ce script gère le chargement de plus de publications (photos) 
   ainsi que l'application de filtres sur la page, à partir du fichier functions.php.
*/
(function($) {
    let loading = false; // Indique si le chargement est en cours ou non
    const $loadMoreButton = $('#load-more-posts'); // Sélectionne le bouton "Charger plus"
    const $container = $('.thumbnail-container-accueil'); // Sélectionne le conteneur de vignettes

    // Lors du clic sur le bouton "Charger plus"
    $loadMoreButton.on('click', function () {
        get_more_posts(true); // Appelle la fonction pour obtenir plus de publications
    });

    function get_more_posts(load) {
        let inputPage = $('input[name="page"]');
        let page = parseInt(inputPage.val());
        page = load ? page + 1 : 1;

        // Récupère les valeurs des filtres
        const category = $('select[name="category-filter"]').val();
        const format = $('select[name="format-filter"]').val();
        const dateSort = $('select[name="date-sort"]').val();

        // Affiche dans la console les filtres envoyés
        
        $.ajax({
            type: 'GET',
            url: wp_data.ajax_url,
            data: {
                action: 'load_more_posts',
                page: page,
                category: category,
                format: format,
                dateSort: dateSort
            },
            success: function (response) {
                if (response) {
                    if (load) {
                        $container.append(response);
                    } else {
                        $container.html(response);
                    }
                    $loadMoreButton.text('Charger plus');
                    inputPage.val(page);
                    loading = false;
                } else {
                    if (load) {
                        $loadMoreButton.text('Fin des publications');
                    } else {
                        let txt = '<div style="text-align:center;width:100%; color: #000;font-family: Space Mono, monospace;font-size: 16px;"><p>Aucun résultat ne correspond aux filtres de recherche.</p></div>';
                        $container.html(txt);
                    }
                }
            }
        });
    }

    // Fonction qui écoute les changements de sélection pour chaque filtre
    function recursive_change(selectId) {
        $('#' + selectId).change(function () {
            get_more_posts(false); // Recharge les posts à chaque changement de filtre
        });
    }

    // Applique la fonction aux sélecteurs de filtres si présents dans le DOM
    if ($('#category-filter').length) recursive_change('category-filter');
    if ($('#format-filter').length) recursive_change('format-filter');
    if ($('#date-sort').length) recursive_change('date-sort');

})(jQuery); // ← On passe jQuery en paramètre
