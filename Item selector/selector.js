!(function($) {
  "use strict";

  // Preloader
  $(window).on('load', function() {
    if ($('#preloader').length) {
      $('#preloader').delay(100).fadeOut('slow', function() {
        $(this).remove();
      });
    }
  });

  // Menu list isotope and filter
  $(window).on('load', function() {
    var menuIsotope = $('.menu-container').isotope({
      itemSelector: '.menu-item',
      layoutMode: 'fitRows'
    });

    $('#menu-flters li').on('click', function() {
      $("#menu-flters li").removeClass('filter-active');
      $(this).addClass('filter-active');

      menuIsotope.isotope({
        filter: $(this).data('filter')
      });
    });
  });

})(jQuery);

// Value Returning selected items
function addToCart() {
  const selectedItems = [];
  const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');

  checkboxes.forEach(checkbox => {
    const item = {
      id: checkbox.id,
      name: checkbox.getAttribute('data-name'),
      price: checkbox.getAttribute('data-price'),
      image: checkbox.closest('.menu-item').querySelector('.menu-img').src
    };
    selectedItems.push(item);
  });

  localStorage.setItem('cartItems', JSON.stringify(selectedItems));
}
