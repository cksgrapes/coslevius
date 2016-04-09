$(function(){
  slider();
});

function slider() {
  // $('.top-slide__wrap').slick();
  $('.top-slide__wrap').slick({
    // slidesToShow: 1,
    infinite: true,
    variableWidth: true,
    centerMode: true,
    autoplay: true,
    autoplaySpeed: 3000,
    // appendArrows: $('.top-side__ctrls'),
    // prevArrow: '<li class="top-side__ctrls__prev">右</li>',
    // nextArrow: '<li class="top-side__ctrls__next">左</li>',
    responsive: [
      {
        breakpoint: 640,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: false,
          mobileFirst: true,
          variableWidth: false,
          centerMode: false
        }
      }
    ]
  });
}
