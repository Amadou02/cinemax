// récupère l'élément toast
var notice = document.querySelector('.toast');

if (notice) {
  // initialisation du toast 
  var bsToast = new bootstrap.Toast(notice, {
    animation: true, // animation lors de l'affichage
    autohide: true, // disparait automatiquement
    delay: 5000 // durée de vie
  });
  // affichage à l'écran
  bsToast.show();
}

// slider slick
$(function () {

  $('#pills-related-movie-tab').on('shown.bs.tab', function (e) {
    console.log(e);
    $('.similar').slick('refresh');
  });

  $('.similar').slick({
    slidesToShow: 4,
    slidesToScroll: 4,
    centerMode: true,
    dots: true,
    arrows: false,
    mobileFirst: true,
    adaptiveHeight: true,
  });
});