/**
 * Materialize Stuff - Init
 */
(function($,Materialize){
    $(document).ready(function(){
        // Collapsible (aka accordian) sections
        $('.collapsible').collapsible();
    });
})(jQuery,M);

/**
 * Materialize Stuff - extenders
 */
(function($,Materialize){
    /**
     * Fix expandable cards - auto height on expandable content
     */
    function materializeAutoCardHeight(){
        // Get all expandable cards
        $('div.card > .card-reveal').parent().each(function(index){
            var card = this;
            // Reset card min height in-case re-running
            $(card).css({
                'min-height' : 'unset'
            });
            var cardReveal = $(card).children().closest('.card-reveal');
            window.cardReveal = cardReveal;
            // First, remove the hidden overflow and fixed 100% height so we can get computed height. Also make sure display is true
            card.style.overflow = 'visible';
            cardRevealInitialDisplay = cardReveal.css('display');
            cardReveal.css({
                'overflow-y' : 'visible',
                // 'height' : 'auto',
                'display' : 'unset'
            });
            // Get the computed height of the inner-reveal card, then set entire card max height
            $(card).css({
                'min-height' : getComputedStyle(cardReveal[0]).height
            });
            cardReveal.css({'display' : cardRevealInitialDisplay});
        });
    }
    if ($('div.card > .card-reveal').length > 0){
        $(window).on('resize',function(){
            materializeAutoCardHeight();
        });
    }

    // Custom materialize init stuff
    $(document).ready(function(){
        materializeAutoCardHeight();
    });
})(jQuery,M);

/**
 * Rest of stuff
 */
(function($,Materialize){
    $(document).ready(function(){
        // wow.js init
        new WOW().init();
    });
})(jQuery,M);