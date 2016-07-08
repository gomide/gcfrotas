(function($){
  $(function(){

    $('.button-collapse').sideNav({
        menuWidth: 100
    });
    
       $(".fechaAba").click(function(evento){
      $('.button-collapse').sideNav('hide');
        });
     

  }); // end of document ready
})(jQuery); // end of jQuery name space