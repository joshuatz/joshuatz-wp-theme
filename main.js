(function($){
    // Materialize and some other stuff is deferred, so wait for document ready
    helpers.onDomReady(function(){
        var Materialize = window.M;
        jtzwpMaterializeInit(Materialize);
        jtzwpMaterializeExtend();
        // wow.js init
        window.wow = new WOW({
            //animateClass : 'animated'
        });
        wow.init();
        // Fancybox
        jtzwpFancybox();
        // masonry
        jtzwpMasonryInit();
        // sticky
        jtzwpStickyInit();
        // My custom init stuff
        jtzwpCustomInit();
    });

    // Site Search
    $('#siteSearchForm').on('submit',siteSearch);
    function siteSearch(query){
        if (typeof(query)!=='string' || typeof(query.length)!=='undefined' && query.length < 1){
            query = helpers.qs('.siteSearchInput').value;
        }
        if (query){
            var searchPage = 'https://cse.google.com/cse?cx=006023929046275200110:crr5g9pbyae&q=' + encodeURI(query);
            window.open(searchPage,'_blank');
        }
    }

    /**
     * Materialize Stuff - Init
     */
    function jtzwpMaterializeInit(Materialize){
        // Collapsible (aka accordian) sections
        $('.collapsible').collapsible();
        // Modals
        helpers.qsa('.modal').forEach(function(elem){
            var modal = elem;
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
        
        // Tooltips
        $('.tooltipped').tooltip();
    }

    /**
     * Materialize Stuff - extenders
     */
    function jtzwpMaterializeExtend(){
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

        function forceWowAnimateOnCardReveal(){
            // Get all expandable cards
            $('div.card > .card-reveal').parent().each(function(index){
                var card = this;
                // Attach listener to all activator triggers
                $(card).find('.activator').on('click',function(){
                    $(card).find('.card-reveal .wow').each(function(){
                        wow.show(this);
                    });
                });
            });
        }

        // Custom materialize init stuff
        helpers.onDomReady(function(){
            materializeAutoCardHeight();
            forceWowAnimateOnCardReveal();
        });
    }

    /**
     * Masonry stuff
     */
    function jtzwpMasonryInit(){
        $('.customToolsMasonryAuto').masonry({
            itemSelector: '.customToolListing'
        });
    }

    /**
     * My custom init stuff
     */

    function jtzwpCustomInit(){
        // Prevent duplicate share buttons
        var $sidebarShareWidget = $('.innerContentMainSidebar .jtzwpShareButtons.widget');
        var $footerShareWidget = $('.underpostWidgetArea.sidebar .jtzwpShareButtons.widget');
        if ($sidebarShareWidget.length > 0 && $footerShareWidget.length > 0){
            // Hide footer widget
            $footerShareWidget.hide();
            // If that was the only widget in the footer, hide entire footer
            if ($footerShareWidget.parent().children().length === 1){
                $footerShareWidget.parent().hide();
            }
        }
    }

    /**
     * Sticky Stuff
     */
    function jtzwpStickyInit(){
        $('.pushpinSticky').each(function(){
            var elem = this;
            jtzwpPushpin(elem);
            // Since pushpin breaks on resize of window, setup listeners and destroy / re-init on resize
            $(window).resize(function(){
                $(elem).pushpin('destroy');
                jtzwpPushpin(elem);
            });
        });
    }

    function jtzwpPushpin(elem){
        $elem = $(elem);
        // Use a default top margin equal to the height of the top nav bar
        var stickyTopOffset = $('.jtnavbar-inner').height();
        var stickyBottomOffset = 0;
        // Allow overriding of offset
        if (elem.hasAttribute('data-offset')){
            stickyTopOffset = parseFloat(elem.getAttribute('data-offset'));
        }
        if (elem.hasAttribute('data-extratopoffset')){
            stickyTopOffset += parseFloat(elem.getAttribute('data-extratopoffset'));
        }
        if (elem.hasAttribute('data-extrabottomoffset')){
            stickyBottomOffset = parseFloat(elem.getAttribute('data-extrabottomoffset'));
        }
        // Target is the thing our sticky element is sticking within
        var $target = $($elem.attr('data-target'));
        $target = $target.length > 0 ? $target : $(elem.parentElement);
        $elem.pushpin({
            offset: stickyTopOffset,
            top: $target.offset().top,
            bottom: $target.offset().top + $target.outerHeight() - $elem.height() - stickyBottomOffset
        });
    }

    /**
     * Fancybox stuff
     */
    function jtzwpFancybox(){
        // Fancybox-3
        if (typeof($.fancybox)!=='undefined' && typeof($.fancybox.defaults)==='object'){
            $.fancybox.defaults.arrows = true;
            /**
             * Function to automatically turn an image into a fancybox-3 trigger
             */
            function forceFancyBoxOnImage(imgTag,OPT_GalleryId){
                var copyableClasses = ['aligncenter'];
                window.globalForceFancyBoxCount = (window.globalForceFancyBoxCount || 0);
                var galleryId = (OPT_GalleryId || 'gallery_' + window.globalForceFancyBoxCount);
                var linkWrapper = imgTag.parentElement;
                var isLinkWrapped = (linkWrapper && linkWrapper.nodeName==='A');
                // If not link wrapped, do so
                if (!isLinkWrapped){
                    linkWrapper = document.createElement('a');
                    imgTag.parentElement.insertBefore(linkWrapper,imgTag);
                    // Get the link to the full size image, and set it as the href on the link wrapper
                    var fullSizeImageLink = imgTag.getAttribute('src').replace(/(-\d+x\d*)(\.[^.]+$)/g,"$2");
                    linkWrapper.setAttribute('href',fullSizeImageLink);
                    // Move the img tag into the link wrapper
                    linkWrapper.appendChild(imgTag);
                }
                // Get parent element of imgTag, which now has to be an A tag wrapper
                var linkTag = imgTag.parentElement;

                // If image link is missing fancybox trigger
                if (linkTag.getAttribute('data-fancybox')==null || linkTag.getAttribute('data-fancybox')==''){
                    linkTag.setAttribute('data-fancybox',galleryId);
                }
                // If image link is missing caption
                if (linkTag.getAttribute('data-caption')==null || linkTag.getAttribute('data-caption')==''){
                    var alt = imgTag.getAttribute('alt');
                    if (alt && alt!==''){
                        linkTag.setAttribute('data-caption',alt);
                    }
                }
                // Check for CSS classes that should be copied from the <img> tag to the <a></a> wrapper
                for (var x=0; x<copyableClasses.length; x++){
                    if (imgTag.classList.contains(copyableClasses[x]) && linkWrapper.classList.contains(copyableClasses[x])===false){
                        linkWrapper.classList.add(copyableClasses[x]);
                    }
                }

                // Increment global counter
                window.globalForceFancyBoxCount++;
            }
            /**
             * Find images that are not currently setup to trigger fancybox, and modify them to do so
             */
            // First, find galleries
            $('.gallery').each(function(){
                var galleryId = this.getAttribute('id');
                $(this).find('.gallery-item a > img').each(function(){
                    forceFancyBoxOnImage(this,galleryId);
                });
            });
            // Find single images that are not set to trigger fancybox, but do link
            $('a > img[class*="wp-image-"]').each(function(){
                forceFancyBoxOnImage(this);
            });
        }
    }

    /**
     * Rest of stuff
     */
    (function($){

        // Debug stuff
        if (window.isDebug){
            // SEO
            window.setTimeout(function(){
                var description = $('meta[name="description"]').attr('content');
                console.group('SEO Stuff');
                    if (/noindex/.test($('meta[name="robots"]').attr('content'))){
                        console.warn('!!! - Page is set to noindex - !!!');
                        console.log($('meta[name="robots"]')[0]);
                    }
                    console.log('Title = ' + $('title').text());
                    if (typeof(description)==='undefined'){
                        console.warn('Description is not set!!!');
                    }
                    else {
                        console.log('Description = ' + description);
                        console.log('Description Length = ' + description.length + ' / 160');
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

        /**
         * Analytics tracking
         */
        // Fire an event
        window.fireEvent = function(action,category,label,value){
            var eventConfig = {
                'action' : action,
                'category' : category,
                'label' : label,
                'value' : value
            }
            var acceptedKeys = ['category','label','value'];
            if (typeof(action)==='object'){
                eventConfig = action;
            }
            var formattedEventParams = {};
            for (var x=0; x<acceptedKeys.length; x++){
                currKey = acceptedKeys[x];
                if (typeof(eventConfig[currKey])!=='undefined'){
                    formattedEventParams.currKey = eventConfig.currKey;
                }
            }
            if (typeof(eventConfig['action'])==='string'){
                if (typeof(window['gtag'])!=='undefined'){
                    gtag('event', eventConfig.action, formattedEventParams);
                }
                else if (typeof(window['ga'])!=='undefined') {
                    ga('send',{
                        hitType : 'event',
                        eventCategory : formattedEventParams.category,
                        eventAction : formattedEventParams.action,
                        eventLabel : formattedEventParams.label,
                        eventValue : formattedEventParams.value
                    });
                }
                return true;
            }
            else {
                return false;
            }
        }
        
        // Highlight.js
        if (typeof(window.hljs)==='object'){
            hljs.initHighlightingOnLoad();
        }

        // PrismJS
        if (typeof(PrismToolbar)==='function'){
            window.jPrismToolbar = new PrismToolbar({
                autoFix: true
            });
            setTimeout(() => {
                // Let prism load
                jPrismToolbar.autoInitAll();
            }, 500);
        }

        // Geo-Content Filtered
        window.unhideByGeography = function(filters,OPT_token,selector){
            function strToRegExp(e){var r=/^\/(.*)\/([igmuy]{0,5})$/;if(r.test(e)){var n=r.exec(e)[1],t=r.exec(e)[2];return new RegExp(n,t)}return new RegExp(e)}
            getIpInfo(OPT_token,function(ipInfo){
                var matchBlocked = false;
                for (var x=0; x<filters.length; x++){
                    var filter = filters[x];
                    if (typeof(filter.filterVal)==='string'){
                        if (!(filter.infoKey in ipInfo)){
                            matchBlocked = true;
                        }
                        else {
                            matchBlocked = strToRegExp(filter.filterVal).test(ipInfo[filter.infoKey])===false;
                        }
                    }
                    if (matchBlocked){
                        if (isDebug){
                            console.group('Geo content blocked by filter:');
                                console.log(filter);
                            console.groupEnd();
                        }
                        break;
                    }
                }
                if (!matchBlocked){
                    document.querySelectorAll(selector).forEach(function(elem){
                        elem.style.opacity = 0;
                        elem.classList.remove('hide');
                        setTimeout(function(){
                            elem.style.opacity = 1;
                        },100);
                    });
                }
            });
        }
        function getIpInfo(OPT_token,callback){
            var STORAGE_KEY = 'cachedIpInfo';
            if (localStorage.getItem(STORAGE_KEY)){
                try {
                    callback(JSON.parse(localStorage.getItem(STORAGE_KEY)));
                    return;
                }
                catch (e){
                    //
                }
            }
            var endPoint = 'https://ipinfo.io';
            var xhr = new XMLHttpRequest();
            xhr.addEventListener('load',function(){
                if (xhr.status === 200){
                    var ipInfo = JSON.parse(xhr.responseText);
                    callback(ipInfo);
                    localStorage.setItem(STORAGE_KEY,JSON.stringify(ipInfo));
                }
                else {
                    if (isDebug){
                        console.warn('Bad response from IpInfo:');
                        console.log(res);
                    }
                }
            });
            xhr.open('GET',endPoint);
            xhr.setRequestHeader('Accept','application/json');
            if (typeof(OPT_token)==='string'){
                xhr.setRequestHeader('Authorization','Bearer ' + OPT_token);
            }
            xhr.send();
        }
        function unhideByGeographyObj(input){
            window.unhideByGeography(input.filters,input.token,input.selector);
        }
        window.unhideByGeographyArr = (window.unhideByGeographyArr || []);
        window.unhideByGeographyArr.forEach(function(input){unhideByGeographyObj(input);});
        window.unhideByGeographyArr.push = function(input){
            unhideByGeographyObj(input);
        };

        /**
         * Wordpress Kludges
         */
        // Wordpress likes to wrap everything in <p></p> tags, including images, which screws up centering. This will "unwrap"
        // Commented out, handled with CSS right now
        //$('p > a[href] > img[class*="wp-image-"]').parent().unwrap();
    })(jQuery);
})(jQuery);