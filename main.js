/**
 * Materialize Stuff - Init
 */
(function($,Materialize){
    $(document).ready(function(){
        // Collapsible (aka accordian) sections
        $('.collapsible').collapsible();
        // Modals
        $('.modal').each(function(){
            var modal = this;
            var modalConfig = {};
            var modalOptions = ['opacity','inDuration','outDuration','onOpenStart','onOpenEnd','onCloseStart','onCloseEnd','preventScrolling','dismissible','startingTop','endingTop'];
            var matchingOptions = 0;
            for (var x=0; x<modalOptions.length; x++){
                var optionAttrName = 'data-' + modalOptions[x];
                if (modal.hasAttribute(optionAttrName) && modal.getAttribute(optionAttrName)!==''){
                    modalConfig[modalOptions[x]] = modal.getAttribute(optionAttrName);
                    matchingOptions++;
                }
            }
            if (matchingOptions > 0){
                $(modal).modal(modalConfig);
            }
            else {
                $(modal).modal();
            }
        });

        // Check to see if page is supposed to load with modal already open for business card
        if (document.location.hash === '#businessCardMaterializeModal'){
            Materialize.Modal.getInstance($('#businessCardMaterializeModal')[0]).open();
        }
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
(function($){
    $(document).ready(function(){
        // wow.js init
        new WOW().init();

        // Debug stuff
        if (window.isDebug){
            // SEO
            window.setTimeout(function(){
                var description = $('meta[name="description"]').attr('content');
                console.group('SEO Stuff');
                    console.log('Title = ' + $('title').text());
                    if (typeof(description)==='undefined'){
                        console.warn('Description is not set!!!');
                    }
                    else {
                        console.log('Description = ' + description);
                        console.log('Description Length = ' + description.length + ' / 60');
                    }
                    if ($('meta[name="keywords"]').length){
                        console.log('Keywords = ' + $('meta[name="keywords"]').attr('content'));
                    }
                    console.group('Canonical Info');
                        console.log('Is Current Page = *' + ($('link[rel="canonical"]').attr('href') === document.location.href).toString().toUpperCase() + '*');
                        console.log('Canonical URL = ' + $('link[rel="canonical"]').attr('href'));
                    console.groupEnd();
                    console.group('Headings');
                        var maxHCount = 8;
                        for (var x=1; x<maxHCount; x++){
                            var headingCount = $('h' + x).length;
                            if (x<=3 || headingCount > 0){
                                console.log('<h' + x + '></h' + x + '> Count = ' + headingCount);
                            }
                        }
                    console.groupEnd();
                console.groupEnd();
            },100);
        }

        // Fancybox-3
        if (typeof($.fancybox)!=='undefined' && typeof($.fancybox.defaults)==='object'){
            $.fancybox.defaults.arrows = true;
        }
    });
})(jQuery);