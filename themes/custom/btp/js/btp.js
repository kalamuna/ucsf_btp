(function ( btp, $, window, undefined) {

  btp.initialize = function(context,settings){
    btp.sidebarMatchHeight();
  }

  // let's get busy!
  Drupal.behaviors.btp = {
    attach: function (context, settings) {
      // Called on domready, but not in ajax attach events.
      if (context == '[object HTMLDocument]'){
        btp.initialize(context, settings);
      }
    }
  };
  
  /**
   * The right sidebar is always on so we need to make sure it's the same height
   * as the content region despite what's inside of it.
   */
  btp.sidebarMatchHeight = function(){
    //debugger;
    //$('.main-container .row > *').matchHeight();
  }
    
  // makes sure onresize doesnt get called too frequently
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
    // code here…
  }, 30 );

})( window.btp = window.btp || {}, jQuery, window, undefined );
