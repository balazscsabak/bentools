// import Swiper JS
// import Swiper from 'swiper';
import Swiper from 'swiper/bundle';

$(() => {
    const heroSwiper = new Swiper('.hero-swiper', {
        // Optional parameters
        loop: true,
      
        // If we need pagination
        pagination: {
          el: '.swiper-pagination',
        },
      
        // Navigation arrows
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      
        slideClass: 'hero-slide',
        
      });

      const productImageSwiper = new Swiper(".product-image-swiper", {
        slidesPerView: 3,
        spaceBetween: 10,
        
        navigation: {
          nextEl: '.product-swiper-next',
          prevEl: '.product-swiper-prev',
        },
      });

      // productImageSwiper.on('slideChangeTransitionEnd', function(e) {
      //   let selectedImageSrc = $('.swiper-slide-active').find('img').attr('src');

      //   $('#product-featured-image').attr("src", selectedImageSrc);
      // })

      $(document).on('click', '.product-swiper-image', function(e) {
        let selectedImageSrc = $(e.target).attr('src');
        $('#product-featured-image').attr("src", selectedImageSrc);
      })
})