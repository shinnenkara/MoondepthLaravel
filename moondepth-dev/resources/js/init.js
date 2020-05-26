(function($){
  $(function(){
    $('.sidenav').sidenav();

    $('input#username_input, input#topic_input, textarea#subject_text_input').characterCounter();

    $(".dropdown-trigger").dropdown({
        hover: false
    });
  }); // end of document ready
})(jQuery); // end of jQuery name space
