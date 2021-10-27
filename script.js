$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

var searchBar = $("#searchBar");
var search = $('.search');

searchBar.focusin(function() {
  search.addClass('active');
});
searchBar.focusout(function() {
  search.removeClass('active');
});