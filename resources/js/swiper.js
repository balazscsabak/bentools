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
        
        // And if we need scrollbar
        // scrollbar: {
        //   el: '.swiper-scrollbar',
        // },
      });

      const productImageSwiper = new Swiper(".product-image-swiper", {
        slidesPerView: 3,
        spaceBetween: 10,
        loop: true,
        slideToClickedSlide: true,
      });
})