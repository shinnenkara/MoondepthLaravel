(function($){
    $(function(){
        $('.sidenav').sidenav();

        $('#to-top-button').click(function(){
            let scrollSpeed = 500;

            $('html, body').animate({
              scrollTop: 0
            }, scrollSpeed, 'swing', function() {
                console.log("At top");
            })
        });

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            let toTopButton = $("#to-top-button");

            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                toTopButton.show();
            } else {
                toTopButton.hide();
            }
        };

        $('input#username_input, input#topic_input, textarea#subject_text_input').characterCounter();

        $(".dropdown-trigger").dropdown({
            hover: false
        });
    }); // end of document ready
})(jQuery); // end of jQuery name space
