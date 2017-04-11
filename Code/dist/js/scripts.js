$('nav img').click(function() {
  $('.mobile-menu').slideToggle();
})
$("#student-favorites .favorited, #business-favorites .favorited").click(function() {
  $(this).find('img').toggle();
})
$("#opportunities-list .favorited, #talents-list .favorited").click(function() {
   $(this).find('img').toggle();
})
