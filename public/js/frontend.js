(function ($) {
    /**
     * 
     * @returns {Frontend}
     */
    function Frontend() {
        $.scrollUp({
            scrollName: 'scroll-up', // Element ID
            scrollText: '<i class="icon-up-dir"></i>' // Text for element
        });
    }

    $('document').ready(function () {
        new Frontend();
    });

})(jQuery);
