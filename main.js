/**
 * Materialize Stuff
 */
(function($,Materialize){
    /**
     * Fix expandable cards - auto height on expandable content
     */
    // Get all expandable cards
    $('div.card > .card-reveal').parent().each(function(index){
        var card = this;
        var cardReveal = $(card).children().closest('.card-reveal');
        window.cardReveal = cardReveal;
        // First, remove the hidden overflow and fixed 100% height so we can get computed height. Also make sure display is true
        card.style.overflow = 'visible';
        cardRevealInitialDisplay = cardReveal.css('display');
        cardReveal.css({
            'overflow-y' : 'visible',
            'height' : 'auto',
            'display' : 'unset'
        });
        // Get the computed height of the inner-reveal card, then set entire card max height
        $(card).css({
            'min-height' : getComputedStyle(cardReveal[0]).height
        });
        cardReveal.css({'display' : cardRevealInitialDisplay});
    });
    
})(jQuery,M);

/**
 * Rest of stuff
 */
(function($,Materialize){

})(jQuery,M);