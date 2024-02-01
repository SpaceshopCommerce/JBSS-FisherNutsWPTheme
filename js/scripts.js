$(document).ready(function () {
  $(".faq-item-q").click(function () {
    var parent = $(this).parent().parent();
    parent.toggleClass("open");
    parent.find(".faq-item-a").slideToggle();
  });

  $(".tip-button-how-to").click(function () {
    $(".tip-button-how-to").toggleClass("active");
    $(".tip-button-hacks").removeClass("active");
    $(".how-to-section").slideToggle(500);
    // $('.hacks-section').slideUp(500);
    $(".hacks-section").hide();
  });

  $(".tip-button-hacks").click(function () {
    $(".tip-button-hacks").toggleClass("active");
    $(".tip-button-how-to").removeClass("active");
    $(".hacks-section").slideToggle(500);
    // $('.how-to-section').slideUp(500);
    $(".how-to-section").hide();
  });

  // Product Image Grid
  $(".product-image-item").mouseenter(function () {
    let index = $(this).attr("data-index");
    // console.log("Hover: " + index);
    $(".product-image-large")
      .removeClass("active")
      .filter("[data-index=" + index + "]")
      .addClass("active");
  });
  $(".product-image-item").click(function () {
    let index = $(this).attr("data-index");
    // console.log("Hover: " + index);
    $(".product-image-large")
      .removeClass("active")
      .filter("[data-index=" + index + "]")
      .addClass("active");
  });

  $(".prod-used-row").slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 6000,
  });

  $(".recipe-ingredient .ingredient_name").each(function () {
    var item = $(this);
    var parent = item.parent();
    // console.log('Inner Text: ' + item.html());
    if (~item.html().indexOf("Fisher")) {
      parent.addClass("bold");
    }
  });

  function hoverVideo(e) {
    $("video", this).get(0).play();
  }
  function hideVideo(e) {
    $("video", this).get(0).pause();
    $("video", this).get(0).currentTime = 0;
  }

  let figure = $(".video-hover").hover(hoverVideo, hideVideo);
});
