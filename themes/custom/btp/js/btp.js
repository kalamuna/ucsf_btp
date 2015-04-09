(function ( btp, $, window, undefined) {
  Drupal.behaviors.btp = {
    attach: function (context, settings) {
      $('body').once(function(){
        btp.initialize(context, settings);
      });
    }
  };
  
  /**
   * Kick off.
   */
  btp.initialize = function(context, settings){
    btp.menuHoverfix();
  };

  // Makes sure onresize doesnt get called too frequently
  // improves page performance
  // http://davidwalsh.name/javascript-debounce-function
  btp.debounce = function(func, wait, immediate) {
    var timeout;
    return function() {
      var context = this, args = arguments;
      var later = function() {
        timeout = null;
        if (!immediate) func.apply(context, args);
      };
      var callNow = immediate && !timeout;
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
      if (callNow) func.apply(context, args);
    };
  };

  btp.onResize = btp.debounce( function(){
  }, 30 );
  
  /**
   * Show dropdown menu on hover but only for layouts larger than sm.
   */
  btp.menuHoverfix = function(context, settings){
    var dropdown = $('#navbar ul.navbar-nav li.expanded');

    $('#navbar ul.navbar-nav li.expanded').on({
      mouseenter: menuHoverToggle,
      mouseleave: menuHoverToggle,
    });
  };
  
  /**
   * Show dropdown menu on hover but only for layouts larger than sm.
   */
  function menuHoverToggle(e){
    var mq = window.matchMedia( "(min-width: 768px)" );
    if (mq.matches) {
      $(this).closest('li').toggleClass('open');
    }
  }

})( window.btp = window.btp || {}, jQuery, window, undefined );
