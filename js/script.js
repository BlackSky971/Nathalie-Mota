jQuery(document).ready(function($) {
    $('#open-fullscreen-menu-button').click(function(e) {
      e.stopPropagation();
      $('header').addClass('mobile-menu-opened');
      console.log('BOUTON CLIQUÉ!');
    });
  
    $('#close-fullscreen-menu-button').click(function() {
      $('header').removeClass('mobile-menu-opened');
      console.log('MENU FERMÉ!');
    });
  
    $(document).click(function(event) {
      if (!$('header').has(event.target).length && !$('header').is(event.target)) {
        $('header').removeClass('mobile-menu-opened');
      }
    });
  });
  
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
          $("#ref-photo").val($(this).data('photo-ref'));
      });
  });
  
}


