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
   * Hovering over the drop down caret stops the hover on the main anchor with the stlying
   */
  btp.menuHoverfix = function(context, settings){
    $('#navbar ul.navbar-nav li.expanded a.dropdown').on({
      mouseenter: menuHoverToggle,
      mouseleave: menuHoverToggle,
    });
  };
  
  /**
   * 
   */
  function menuHoverToggle(e){
    $(this).siblings('a[data-target]').toggleClass('hover');
  }

})( window.btp = window.btp || {}, jQuery, window, undefined );
