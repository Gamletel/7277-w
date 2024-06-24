jQuery(document).ready(function($){

    const worksSwiper = new Swiper('#works-block .swiper',{
        breakpoints:{
            320:{
                slidesPerView: 1,
                spaceBetween: 15,
            },
            375:{
                slidesPerView: 2,
                spaceBetween: 15,
            },
            769:{
                slidesPerView: 3,
                spaceBetween: 30,
            },
        },
        navigation:{
            prevEl: '#works-block .swiper-btn-prev',
            nextEl: '#works-block .swiper-btn-next',
        },
        pagination:{
            el: '#works-block .swiper-pagination'
        }
    });

});