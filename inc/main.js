(() => {
    const { qsa, qs, onDomReady } = helpers;
    // Materialize and some other stuff is deferred, so wait for document ready
    onDomReady(() => {
        jtzwpMaterializeInit();
        // Image Galleries
        jtzwpImageGalleries();
        // My custom init stuff
        jtzwpCustomInit();
    });

    // Site Search
    document.querySelector('#siteSearchForm').addEventListener('submit', (evt) => {
        // @ts-ignore
        const query = evt.target.querySelector('input').value;
        if (!!query) {
            const searchPage = 'https://cse.google.com/cse?cx=006023929046275200110:crr5g9pbyae&q=' + encodeURI(query);
            window.open(searchPage, '_blank');
        }
    });

    /**
     * Materialize Stuff - Init
     */
    function jtzwpMaterializeInit() {
        // Collapsible (aka accordian) sections
        M.Collapsible.init(qsa('.collapsible'));
        // Modals
        qsa('.modal').forEach((modal) => {
            const modalOptions = [
                'opacity',
                'inDuration',
                'outDuration',
                'onOpenStart',
                'onOpenEnd',
                'onCloseStart',
                'onCloseEnd',
                'preventScrolling',
                'dismissible',
                'startingTop',
                'endingTop'
            ];
            /** @type {Record<string, any>} */
            const modalConfig = {};
            for (let x = 0; x < modalOptions.length; x++) {
                const optionAttrName = 'data-' + modalOptions[x];
                if (!!modal.getAttribute(optionAttrName)) {
                    modalConfig[modalOptions[x]] = modal.getAttribute(optionAttrName);
                }
            }
            M.Modal.init(modal, modalConfig);
        });

        // Check to see if page is supposed to load with modal already open for business card
        if (document.location.hash === '#businessCardMaterializeModal') {
            M.Modal.getInstance(qs('#businessCardMaterializeModal')).open();
        }

        // Tooltips
        M.Tooltip.init(qsa('.tooltipped'));
    }

    /**
     * My custom init stuff
     */

    function jtzwpCustomInit() {
        // Prevent duplicate share buttons
        const sidebarShareWidget = qs('.innerContentMainSidebar .jtzwpShareButtons.widget');
        const footerShareWidget = qs('.underpostWidgetArea.sidebar .jtzwpShareButtons.widget');
        if (sidebarShareWidget && footerShareWidget) {
            // Hide footer widget
            footerShareWidget.remove();
            // If that was the only widget in the footer, hide entire footer
            if (footerShareWidget.parentElement.children.length <= 1) {
                footerShareWidget.parentElement.remove();
            }
        }
    }

    function jtzwpImageGalleries() {
        const gallerySelector = '.gallery, .wp-block-gallery, #gallery';
        if (!window.baguetteBox) {
            return;
        }

        qsa(gallerySelector).forEach((/** @type {HTMLElement} */ galleryElem) => {
            const galleryId = galleryElem.id;
            // Make sure that all img tags are wrapped and marked as part of gallery
            galleryElem
                .querySelectorAll('.blocks-gallery-item img, .gallery-item img')
                .forEach((/** @type {HTMLImageElement} */ imgTag) => {
                    helpers.forceImageLinkWrapped(imgTag);
                    imgTag.setAttribute('data-gallery', galleryId);
                });
        });
        window.baguetteBox.run(gallerySelector);
        // Find single images that are not set to trigger fancybox, but do link
        // $('a > img[class*="wp-image-"]').each(function(){
        //     forceFancyBoxOnImage(this);
        // });
    }

    /**
     * Rest of stuff
     */
    (() => {
        // Debug stuff
        if (window.isDebug) {
            // SEO
            window.setTimeout(function () {
                const description = qs('meta[name="description"]').getAttribute('content');
                console.group('SEO Stuff');
                const keywordsTag = qs('meta[name="keywords"]');
                const robotsTag = qs('meta[name="robots"]');
                const canonicalLinkTag = qs('link[rel="canonical"]');
                if (robotsTag && /noindex/.test(robotsTag.getAttribute('content'))) {
                    console.warn('!!! - Page is set to noindex - !!!');
                    console.log(robotsTag);
                }
                console.log('Title = ' + qs('title').innerText);
                if (typeof description === 'undefined') {
                    console.warn('Description is not set!!!');
                } else {
                    console.log('Description = ' + description);
                    console.log('Description Length = ' + description.length + ' / 160');
                }
                if (keywordsTag) {
                    console.log('Keywords = ' + keywordsTag.getAttribute('content'));
                }
                console.group('Canonical Info');
                if (canonicalLinkTag) {
                    console.log(
                        'Is Current Page = *' +
                            (qs('link[rel="canonical"]').getAttribute('href') === document.location.href)
                                .toString()
                                .toUpperCase() +
                            '*'
                    );
                    console.log('Canonical URL = ' + qs('link[rel="canonical"]').getAttribute('href'));
                } else {
                    console.log('No canonical tag set');
                }
                console.groupEnd();
                console.group('Headings');
                const maxHCount = 8;
                for (let x = 1; x < maxHCount; x++) {
                    const headingCount = qsa('h' + x).length;
                    if (x <= 3 || headingCount > 0) {
                        console.log('<h' + x + '></h' + x + '> Count = ' + headingCount);
                    }
                }
                console.groupEnd();
                console.groupEnd();
            }, 100);
        }

        /**
         * Analytics tracking
         */
        // Fire an event
        window.fireEvent = function (action, category, label, value) {
            let eventConfig = {
                action: action,
                category: category,
                label: label,
                value: value
            };

            /** @type {Array<keyof typeof eventConfig>} */
            // prettier-ignore
            const acceptedKeys = (Object.keys(eventConfig));
            if (typeof action === 'object') {
                eventConfig = action;
            }

            /** @type {Partial<Record<keyof typeof eventConfig, any>>} */
            const formattedEventParams = {};

            for (let x = 0; x < acceptedKeys.length; x++) {
                const currKey = acceptedKeys[x];
                if (typeof eventConfig[currKey] !== 'undefined') {
                    formattedEventParams[currKey] = eventConfig[currKey];
                }
            }

            if (typeof eventConfig['action'] === 'string') {
                if (typeof window['gtag'] !== 'undefined') {
                    gtag('event', eventConfig.action, formattedEventParams);
                } else if (typeof window['ga'] !== 'undefined') {
                    ga('send', {
                        hitType: 'event',
                        eventCategory: formattedEventParams.category,
                        eventAction: formattedEventParams.action,
                        eventLabel: formattedEventParams.label,
                        eventValue: formattedEventParams.value
                    });
                }
                return true;
            } else {
                return false;
            }
        };

        // PrismJS
        if (typeof PrismToolbar === 'function') {
            window.jPrismToolbar = new PrismToolbar({
                autoFix: true,
                animate: false
            });
            setTimeout(() => {
                // Let prism load
                window.jPrismToolbar.autoInitAll();
            }, 500);
        }

        /**
         * Wordpress Kludges
         */
        // Wordpress likes to wrap everything in <p></p> tags, including images, which screws up centering. This will "unwrap"
        // Commented out, handled with CSS right now
        //$('p > a[href] > img[class*="wp-image-"]').parent().unwrap();
    })();
})();
