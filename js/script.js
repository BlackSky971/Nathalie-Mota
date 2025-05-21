document.addEventListener("DOMContentLoaded", function () {
    const modaleContent = document.querySelector("#contact-modal");
    const modaleBox = document.querySelector(".modale-box");
    console.log(modaleBox)
    const boutonContact = document.querySelector(".contact-btn");
    const formRefPhoto = document.querySelector(".form-ref-photo");
    function openModale(event) {
      if (!modaleContent) return;
      modaleContent.classList.remove("modale-hidden");
  
      if (event && event.currentTarget) {
        const photoRef = event.currentTarget.dataset.photoRef;
        if (formRefPhoto && photoRef) {
          formRefPhoto.value = photoRef;
        }
      }
    }
  
    function closeModale() {
      if (!modaleBox || !modaleContent) return;
      modaleBox.classList.remove("modale-box-anim-in");
      modaleContent.classList.add("modale-anim-out");
      modaleBox.classList.add("modale-box-anim-out");
  
      setTimeout(() => {
        modaleContent.classList.add("modale-hidden");
        modaleContent.classList.remove("modale-anim-out");
        modaleBox.classList.remove("modale-box-anim-out");
        modaleBox.classList.add("modale-box-anim-in");
      }, 500);
    }
  
    if (boutonContact) {
      boutonContact.addEventListener('click', function(e) {
          e.preventDefault();
          openModale(e); // Ajoute l'ouverture de la modale ici
      });
     }
  
  
    if (modaleContent) {
      modaleContent.addEventListener("click", closeModale);
    }
    if (modaleBox) {
      modaleBox.addEventListener("click", (e) => e.stopPropagation());
    }
  
    window.addEventListener("keydown", (e) => {
      if (e.key === "Escape" || e.key === "Esc") {
        closeModale();
      }
    });
  
  }); 

if( jQuery('#myBtn-photo').length ){
  // MODAL CONTACT - SINGLE-PHOTO
  var photoModal = document.getElementById('myModal-photo');
  var photoBtn = document.getElementById("myBtn-photo");
  var photoSpan = document.getElementsByClassName("close-photo")[0];

  // Afficher le modal single-photo
  photoBtn.onclick = function() {
      photoModal.style.display = "block";
  }

  // Masquer le modal single-photo
  photoSpan.onclick = function() {
      photoModal.style.display = "none";
  }

  // Fermer le modal single-photo en cliquant en dehors
  window.onclick = function(event) {
      if (event.target == photoModal) {
          photoModal.style.display = "none";
      }
  }

  // MISE À JOUR DU CHAMP #REF-PHOTO DANS LE FORMULAIRE DE CONTACT 7
  jQuery(document).ready(function($) {
      $("#myBtn-photo").on('click', function() {
          // Définissez la valeur de #ref-photo lorsque le bouton est cliqué.
          $("#ref-photo").val(acfReferencePhoto);
      });
  });
  
}


/*
 if (boutonContact) {
         
        boutonContact.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('test');
        });
       
    }
document.addEventListener('DOMContentLoaded', function () {
    const boutonContact = document.getElementsByClassName ('contact-btn');
    if (!boutonContact) {
        console.error('❌ Le bouton contact n\'existe pas dans le DOM !');
    } else {
        for (var i = 0; i < boutonContact.length; i++) {
            boutonContact[i].addEventListener('click', function(e) {
                e.preventDefault();
                console.log('test');
            });
        }
    }
        fin 
    const modal = document.getElementById('contact-modal');
    const closeModal = document.getElementById('close-modal');

    document.getElementById('open-modal').addEventListener('click', function () {
        modal.style.display = 'block';
    });

    closeModal.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function (e) {
        if (e.target == modal) {
            modal.style.display = 'none';
        }
    });

    $("#contact-btn").on("click", function () {
        let photoTitle = $(this).data("photo");
        $("#contact-modal input[name='ref-photo']").val(photoTitle);
        $("#contact-modal").fadeIn();
    });

    $(".icon-fullscreen").on("click", function (e) {
        e.preventDefault();
        let imgUrl = $(this).closest(".photo-item").find("img").attr("src");
        $("#lightbox img").attr("src", imgUrl);
        $("#lightbox").fadeIn();
    });

    $("#load-more").on("click", function (e) {
        e.preventDefault();
        let button = $(this);
        let page = button.data("page");
        let maxPage = button.data("max");

     $.ajax({
        url: ajax_url.ajaxurl,
        type: "post",
        data: {
        action: "load_more_photos",
        page: page
        },
        success: function (response) {
         $(".photo-grid").append(response);
        button.data("page", page + 1);
        if (page + 1 > maxPage) {
             button.hide();
            }
            }
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
        let boutonContact = document.querySelector('.contact_btn a');
    
        if (boutonContact) {
            boutonContact.addEventListener("click", function (e) {
                e.preventDefault();
                console.log('✅ Bouton contact cliqué !');
            });
        } else {
            console.log('❌ Bouton contact non trouvé dans le DOM !');
        }
    }); */   


