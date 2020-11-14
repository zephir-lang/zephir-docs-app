var documentReady = function (callback) {
  if (document.readyState !== "loading") callback();
  else document.addEventListener("DOMContentLoaded", callback);
};

documentReady(function () {
  var mobileTrigger = document.querySelector('.mobile-menu-trigger');
  var mobileWrapper = document.querySelector('.bd-search-docs-toggle');

  mobileWrapper.addEventListener('click', function (e) {
    if (mobileTrigger.classList.contains('active')) {
      mobileTrigger.classList.remove('active');
    } else {
      mobileTrigger.classList.add('active');
    }
  })
});