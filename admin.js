(function($){
    $(document).ready(function(){
        // don't run validation client side as of right now - just clear error flag on field change
        $('.jtzwp_options_page_form input').each(function(){
            var input = this;
            input.setAttribute('origval',input.value);
        });
        $('.jtzwp_options_page_form input').on('change keyup',function(){
            var input = this;
            if (input.getAttribute('origval')!==input.value){
                input.setAttribute('invalid','unknown');
            }
        });
    });
})(jQuery);